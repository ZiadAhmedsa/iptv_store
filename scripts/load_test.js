import http from 'http';
import https from 'https';

// --- Configuration ---
// Change this to your production URL or your Octane local URL (e.g., http://127.0.0.1:8000)
// DO NOT use php artisan serve for this test, it will fail immediately.
const TARGET_URL = 'http://127.0.0.1:8000/'; 
const TOTAL_REQUESTS = 1000;
const CONCURRENCY = 1000; // All at once

console.log(`🚀 Starting Load Test on: ${TARGET_URL}`);
console.log(`📊 Total Requests: ${TOTAL_REQUESTS} | Concurrency: ${CONCURRENCY}`);

const isHttps = TARGET_URL.startsWith('https');
const requestModule = isHttps ? https : http;

let successCount = 0;
let errorCount = 0;
const startTime = Date.now();

// Function to make a single request
function makeRequest(index) {
    return new Promise((resolve) => {
        const reqStartTime = Date.now();
        const req = requestModule.get(TARGET_URL, (res) => {
            // Consume response data to free up memory
            res.on('data', () => {}); 
            res.on('end', () => {
                if (res.statusCode >= 200 && res.statusCode < 400) {
                    successCount++;
                } else {
                    errorCount++;
                    // console.error(`[Req ${index}] Failed with Status: ${res.statusCode}`);
                }
                resolve(Date.now() - reqStartTime);
            });
        });

        req.on('error', (err) => {
            errorCount++;
            // console.error(`[Req ${index}] Error: ${err.message}`);
            resolve(Date.now() - reqStartTime);
        });
        
        // Timeout to prevent hanging
        req.setTimeout(10000, () => {
            req.destroy();
            errorCount++;
            resolve(Date.now() - reqStartTime);
        });
    });
}

// Execute the test
async function runTest() {
    const promises = [];
    
    // Launch all requests at the exact same time
    for (let i = 0; i < TOTAL_REQUESTS; i++) {
        promises.push(makeRequest(i));
    }

    // Wait for all to complete
    const responseTimes = await Promise.all(promises);
    const endTime = Date.now();
    const totalTime = (endTime - startTime) / 1000; // in seconds

    // Calculate metrics
    const avgResponseTime = responseTimes.reduce((a, b) => a + b, 0) / TOTAL_REQUESTS;
    const maxResponseTime = Math.max(...responseTimes);
    const minResponseTime = Math.min(...responseTimes);

    console.log("\n======================================");
    console.log("📈 Load Test Results");
    console.log("======================================");
    console.log(`⏱️  Total Time Taken: ${totalTime.toFixed(2)} seconds`);
    console.log(`✅ Successful Requests: ${successCount}`);
    console.log(`❌ Failed Requests: ${errorCount}`);
    console.log(`🚀 Requests Per Second: ${(TOTAL_REQUESTS / totalTime).toFixed(2)} req/sec`);
    console.log(`⏳ Avg Response Time: ${avgResponseTime.toFixed(2)} ms`);
    console.log(`🐢 Max Response Time: ${maxResponseTime} ms`);
    console.log(`🐇 Min Response Time: ${minResponseTime} ms`);
    
    if (errorCount > 0) {
        console.log("\n⚠️ WARNING: You had failed requests! If you ran this on 'php artisan serve', this is expected. You need Nginx or Laravel Octane to handle 1000 concurrent requests.");
    } else {
        console.log("\n🎉 SUCCESS: Your server handled 1000 concurrent requests flawlessly!");
    }
}

runTest();
