<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index()
    {
        $settings = [
            'site_name' => Setting::get('site_name', 'Bakri Store'),
            'site_description' => Setting::get('site_description', ''),
            'developer_info' => Setting::get('developer_info', ''),
            'developer_link' => Setting::get('developer_link', ''),
            'theme_color' => Setting::get('theme_color', '#6366f1'),
            'dark_mode_default' => Setting::get('dark_mode_default', '0'),
            'contact_email' => Setting::get('contact_email', ''),
            'contact_phone' => Setting::get('contact_phone', ''),
            'contact_address' => Setting::get('contact_address', ''),
            'whatsapp' => Setting::get('whatsapp', ''),
            'support_email' => Setting::get('support_email', ''),
            'social_facebook' => Setting::get('social_facebook', ''),
            'social_instagram' => Setting::get('social_instagram', ''),
            'social_twitter' => Setting::get('social_twitter', ''),
            'social_whatsapp' => Setting::get('social_whatsapp', ''),
            'payment_paypal_email' => Setting::get('payment_paypal_email', ''),
            'payment_bank_name' => Setting::get('payment_bank_name', ''),
            'payment_bank_account' => Setting::get('payment_bank_account', ''),
            'payment_bank_iban' => Setting::get('payment_bank_iban', ''),
            'logo_path' => Setting::get('logo_path', 'logo.png'),
            'loyalty_earn_methods' => Setting::get('loyalty_earn_methods', "اشترك في المتجر واحصل على 50 نقطة فورية\nاطلب أي باقة واحصل على نقطة مقابل كل ريال\nقيم المنتجات التي اشتريتها واحصل على 10 نقاط"),
            'loyalty_redeem_methods' => Setting::get('loyalty_redeem_methods', "استبدل 500 نقطة بخصم 10% على طلبك\nاستبدل 1000 نقطة بشهر مجاني VIP\nاستبدل نقاطك بكوبونات هدايا"),
        ];
        
        return view('admin.settings.index', compact('settings'));
    }

    public function update(Request $request)
    {
        $data = $request->except(['_token', 'logo']);
        $data['dark_mode_default'] = $request->has('dark_mode_default') ? '1' : '0';
        
        // Handle Logo Upload
        if ($request->hasFile('logo')) {
            $file = $request->file('logo');
            $filename = 'logo_' . time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('branding'), $filename);
            Setting::set('logo_path', 'branding/' . $filename, 'branding');
        }

        foreach ($data as $key => $value) {
            $group = 'general';
            if (str_contains($key, 'contact_') || in_array($key, ['whatsapp', 'support_email'])) $group = 'contact';
            if (str_contains($key, 'payment_')) $group = 'payment';
            if (str_contains($key, 'social_') || in_array($key, ['instagram', 'twitter'])) $group = 'social';
            if (str_contains($key, 'theme_') || $key == 'logo_path') $group = 'branding';
            if (str_contains($key, 'loyalty_')) $group = 'loyalty';
            
            if ($value !== null) {
                Setting::set($key, (string)$value, $group);
            }
        }

        return back()->with('success', 'تم تحديث الإعدادات والهوية البصرية بنجاح!');
    }
}
