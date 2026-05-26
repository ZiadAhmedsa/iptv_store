@extends('layouts.admin')

@section('title', 'تفاصيل الطلب #' . $order->id)
@section('subtitle', 'مراجعة بيانات العميل والمنتجات والعمليات المالية')

@section('actions')
    <div class="flex items-center gap-3">
        <a href="{{ route('admin.orders.index') }}" class="flex items-center gap-2 text-xs font-black text-slate-400 uppercase tracking-widest hover:text-brand-500 transition-colors">
            <i class="ph ph-arrow-right text-lg"></i> العودة للقائمة
        </a>
        <div class="w-px h-4 bg-slate-200 dark:bg-white/10 mx-2"></div>
        @if($order->status != 'completed')
            <form action="{{ route('admin.orders.updateStatus', $order) }}" method="POST">
                @csrf @method('PUT')
                <input type="hidden" name="delivery_status" value="completed">
                <button type="submit" class="bento-button !h-10 !px-6 !text-xs !bg-emerald-500 !shadow-emerald-500/20">
                    <i class="ph ph-check-circle text-lg"></i> إكمال الطلب
                </button>
            </form>
        @endif
    </div>
@endsection

@section('content')
<div class="grid grid-cols-1 lg:grid-cols-12 gap-10 items-start">
    <!-- Left Column: Order Items & Actions -->
    <div class="lg:col-span-8 space-y-8">
        <!-- Items Table -->
        <div class="bento-card overflow-hidden">
            <div class="px-8 py-6 border-b border-slate-50 dark:border-white/5 bg-slate-50/30 dark:bg-white/[0.01]">
                <h3 class="text-sm font-black text-slate-900 dark:text-white flex items-center gap-3">
                    <i class="ph ph-shopping-bag text-brand-500 text-xl"></i> المنتجات المطلوبة
                </h3>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-right border-collapse">
                    <thead>
                        <tr class="text-xs font-black text-slate-400 uppercase tracking-widest border-b border-slate-50 dark:border-white/5 bg-slate-50/50 dark:bg-white/[0.01]">
                            <th class="px-8 py-4">المنتج</th>
                            <th class="px-8 py-4">السعر</th>
                            <th class="px-8 py-4 text-center">الكمية</th>
                            <th class="px-8 py-4">الإجمالي</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-50 dark:divide-white/5">
                        @foreach($order->items ?? [] as $item)
                            <tr class="hover:bg-slate-50/30 dark:hover:bg-white/[0.01] transition-colors group">
                                <td class="px-8 py-6">
                                    <div class="flex items-center gap-4">
                                        <div class="w-12 h-12 rounded-xl bg-brand-500/5 border border-brand-500/10 flex items-center justify-center text-2xl font-black text-brand-500">
                                            <i class="ph ph-package"></i>
                                        </div>
                                        <div>
                                            <p class="text-sm font-bold text-slate-900 dark:text-white group-hover:text-brand-500 transition-colors leading-none mb-1.5">{{ $item->product_name }}</p>
                                            <p class="text-[9px] text-slate-400 font-black uppercase tracking-widest">SKU: #{{ $item->product_id }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-8 py-6 text-sm font-bold text-slate-600 dark:text-slate-300">
                                    {{ number_format($item->price, 0) }} <span class="text-sm font-black text-slate-400 dark:text-slate-500 mr-1">⃁</span>
                                </td>
                                <td class="px-8 py-6 text-center">
                                    <span class="inline-flex items-center justify-center w-8 h-8 rounded-lg bg-slate-100 dark:bg-white/5 font-black text-xs">
                                        {{ $item->quantity }}
                                    </span>
                                </td>
                                <td class="px-8 py-6 text-sm font-black text-brand-500">
                                    {{ number_format($item->subtotal, 0) }} <span class="text-sm font-black text-brand-500 mr-1">⃁</span>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr class="bg-slate-50/50 dark:bg-white/[0.01]">
                            <td colspan="3" class="px-8 py-6 text-left text-xs font-black text-slate-400 uppercase tracking-widest">المجموع النهائي</td>
                            <td class="px-8 py-6 text-xl font-black text-slate-900 dark:text-white tracking-tighter">
                                {{ number_format($order->total, 0) }} <span class="text-sm font-black text-slate-900 dark:text-white mr-1">⃁</span>
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>

        <!-- Management Tools -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <div class="bento-card p-8">
                <div class="flex items-center gap-3 mb-8">
                    <div class="w-8 h-8 rounded-lg bg-brand-500/10 text-brand-500 flex items-center justify-center">
                        <i class="ph ph-gear text-lg"></i>
                    </div>
                    <h3 class="text-sm font-black text-slate-900 dark:text-white">إدارة الحالة</h3>
                </div>

                <form action="{{ route('admin.orders.updateStatus', $order) }}" method="POST" class="space-y-5">
                    @csrf @method('PUT')
                    
                    <div class="space-y-2">
                        <label class="text-[9px] font-black text-slate-400 uppercase tracking-widest px-1">حالة التسليم</label>
                        <select name="delivery_status" class="bento-input !h-11 !text-xs !py-0">
                            <option value="pending" {{ $order->delivery_status == 'pending' ? 'selected' : '' }}>قيد الانتظار</option>
                            <option value="processing" {{ $order->delivery_status == 'processing' ? 'selected' : '' }}>قيد المعالجة</option>
                            <option value="completed" {{ $order->delivery_status == 'completed' ? 'selected' : '' }}>مكتمل</option>
                        </select>
                    </div>
                    
                    <div class="space-y-2">
                        <label class="text-[9px] font-black text-slate-400 uppercase tracking-widest px-1">حالة الدفع</label>
                        <select name="payment_status" class="bento-input !h-11 !text-xs !py-0">
                            <option value="pending" {{ $order->payment_status == 'pending' ? 'selected' : '' }}>قيد الانتظار</option>
                            <option value="paid" {{ $order->payment_status == 'paid' ? 'selected' : '' }}>مدفوع</option>
                            <option value="failed" {{ $order->payment_status == 'failed' ? 'selected' : '' }}>فاشل</option>
                            <option value="refunded" {{ $order->payment_status == 'refunded' ? 'selected' : '' }}>مسترد</option>
                        </select>
                    </div>

                    <button type="submit" class="bento-button !w-full !h-12 !text-xs">
                        <i class="ph ph-arrow-counter-clockwise text-lg"></i> تحديث الحالات
                    </button>
                </form>
            </div>

            <div class="bento-card p-8">
                <div class="flex items-center gap-3 mb-8">
                    <div class="w-8 h-8 rounded-lg bg-brand-500/10 text-brand-500 flex items-center justify-center">
                        <i class="ph ph-note-pencil text-lg"></i>
                    </div>
                    <h3 class="text-sm font-black text-slate-900 dark:text-white">ملاحظات إدارية</h3>
                </div>
                <textarea class="bento-input !h-28 !py-4 !text-xs leading-relaxed resize-none" placeholder="أضف ملاحظات خاصة بهذا الطلب هنا..."></textarea>
                <button type="button" class="bento-button !w-full !h-12 !text-xs !bg-slate-900 !text-white !mt-5">
                    <i class="ph ph-floppy-disk text-lg"></i> حفظ الملاحظات
                </button>
            </div>
        </div>
    </div>

    <!-- Right Column: Context & Customer -->
    <div class="lg:col-span-4 space-y-8">
        <!-- Status Widget -->
        <div class="bento-card p-8">
            <p class="text-[9px] font-black text-slate-400 uppercase tracking-widest mb-6 px-1">حالة الطلب اللحظية</p>
            <div class="flex items-center gap-5 mb-8">
                <div class="w-14 h-14 rounded-2xl {{ $order->status == 'completed' ? 'bg-emerald-500/10 text-emerald-500' : 'bg-amber-500/10 text-amber-500' }} flex items-center justify-center text-2xl font-black shadow-lg">
                    <i class="ph {{ $order->status == 'completed' ? 'ph-check-circle' : 'ph-clock-countdown' }}"></i>
                </div>
                <div>
                    <div class="text-lg font-black text-slate-900 dark:text-white leading-none mb-1.5">{{ $order->status == 'completed' ? 'تم التنفيذ' : 'تحت المعالجة' }}</div>
                    <div class="text-xs font-bold text-slate-400 uppercase tracking-widest">{{ $order->updated_at->diffForHumans() }}</div>
                </div>
            </div>
            <div class="w-full h-1.5 bg-slate-100 dark:bg-white/5 rounded-full overflow-hidden">
                <div class="h-full bg-brand-500 {{ $order->status == 'completed' ? 'w-full' : 'w-1/2' }} transition-all duration-1000"></div>
            </div>
        </div>

        <!-- Customer Widget -->
        <div class="bento-card p-8">
            <p class="text-[9px] font-black text-slate-400 uppercase tracking-widest mb-8 px-1">بيانات العميل</p>
            <div class="flex items-center gap-5 mb-10">
                <div class="w-14 h-14 rounded-2xl bg-brand-500/10 text-brand-500 flex items-center justify-center font-black text-xl shadow-inner">
                    {{ substr($order->user->name, 0, 1) }}
                </div>
                <div class="min-w-0">
                    <p class="text-base font-black text-slate-900 dark:text-white leading-none mb-1.5 truncate">{{ $order->user->name }}</p>
                    <p class="text-[9px] font-black text-brand-500 uppercase tracking-widest">ID: #{{ $order->user->id }}</p>
                </div>
            </div>
            
            <div class="space-y-4">
                <a href="tel:{{ $order->user->phone }}" class="flex items-center justify-between p-4 bg-slate-50/50 dark:bg-white/[0.02] rounded-xl border border-slate-100 dark:border-white/5 hover:border-brand-500/30 transition-all group">
                    <div class="flex items-center gap-3">
                        <i class="ph ph-phone text-lg text-brand-500"></i>
                        <span class="text-xs font-bold text-slate-700 dark:text-slate-300 font-mono">{{ $order->user->phone }}</span>
                    </div>
                    <i class="ph ph-caret-left text-slate-300 group-hover:text-brand-500 transition-colors"></i>
                </a>
                <a href="mailto:{{ $order->user->email }}" class="flex items-center justify-between p-4 bg-slate-50/50 dark:bg-white/[0.02] rounded-xl border border-slate-100 dark:border-white/5 hover:border-brand-500/30 transition-all group">
                    <div class="flex items-center gap-3">
                        <i class="ph ph-envelope text-lg text-brand-500"></i>
                        <span class="text-xs font-bold text-slate-700 dark:text-slate-300 truncate max-w-[140px]">{{ $order->user->email }}</span>
                    </div>
                    <i class="ph ph-caret-left text-slate-300 group-hover:text-brand-500 transition-colors"></i>
                </a>
            </div>
        </div>

        <!-- Payment Info Widget -->
        <div class="bento-card p-8">
            <p class="text-[9px] font-black text-slate-400 uppercase tracking-widest mb-6 px-1">تفاصيل الدفع</p>
            <div class="space-y-4">
                <div class="flex justify-between items-center py-2 border-b border-slate-50 dark:border-white/5">
                    <span class="text-xs font-bold text-slate-500">الوسيلة:</span>
                    <span class="text-xs font-black text-slate-900 dark:text-white uppercase tracking-widest">{{ $order->payment_method ?? 'CREDIT_CARD' }}</span>
                </div>
                <div class="flex justify-between items-center py-2 border-b border-slate-50 dark:border-white/5">
                    <span class="text-xs font-bold text-slate-500">حالة الدفع:</span>
                    <span class="px-2 py-0.5 rounded-lg bg-emerald-500/10 text-emerald-500 text-[10px] font-black uppercase">{{ $order->payment_status ?? 'PAID' }}</span>
                </div>
                <div class="flex justify-between items-center py-2">
                    <span class="text-xs font-bold text-slate-500">المبلغ:</span>
                    <span class="text-sm font-black text-brand-500">{{ number_format($order->total, 0) }} <span class="text-sm font-black text-brand-500 mr-1">⃁</span></span>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
