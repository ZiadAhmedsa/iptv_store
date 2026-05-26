param(
    [string] $MysqlDump = "mysqldump",
    [string] $OutputRoot = "storage/app/backups",
    [int] $RetentionDays = 14
)

$ErrorActionPreference = "Stop"

$timestamp = Get-Date -Format "yyyyMMdd-HHmmss"
$outputDir = Join-Path $OutputRoot $timestamp
New-Item -ItemType Directory -Force -Path $outputDir | Out-Null

$envFile = ".env"
if (-not (Test-Path $envFile)) {
    throw ".env file not found."
}

$envMap = @{}
Get-Content $envFile | Where-Object { $_ -match "^[A-Z0-9_]+=" } | ForEach-Object {
    $parts = $_ -split "=", 2
    $envMap[$parts[0]] = $parts[1].Trim('"')
}

$dbName = $envMap["DB_DATABASE"]
$dbUser = $envMap["DB_USERNAME"]
$dbPass = $envMap["DB_PASSWORD"]
$dbHost = $envMap["DB_HOST"]

if (-not $dbName -or -not $dbUser) {
    throw "DB_DATABASE and DB_USERNAME are required in .env."
}

$dumpPath = Join-Path $outputDir "$dbName.sql"
& $MysqlDump "--host=$dbHost" "--user=$dbUser" "--password=$dbPass" --single-transaction --quick --routines --triggers $dbName | Set-Content -Path $dumpPath -Encoding UTF8

Compress-Archive -Path $dumpPath, "storage/app/public" -DestinationPath (Join-Path $OutputRoot "backup-$timestamp.zip") -Force
Remove-Item -LiteralPath $outputDir -Recurse -Force

$cutoff = (Get-Date).AddDays(-$RetentionDays)
Get-ChildItem $OutputRoot -Filter "backup-*.zip" | Where-Object { $_.LastWriteTime -lt $cutoff } | Remove-Item -Force

Write-Output "Backup completed: $(Join-Path $OutputRoot "backup-$timestamp.zip")"
