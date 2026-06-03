<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\PostCategory;
use App\Models\Tag;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class BlogPostsSeeder extends Seeder
{
    public function run(): void
    {
        $categories = $this->seedCategories();
        $tags = $this->seedTags();
        $this->seedPosts($categories, $tags);
    }

    protected function seedCategories(): array
    {
        $data = [
            [
                'name' => 'Web Development',
                'slug' => 'web-development',
                'description' => 'Tutorials, guides, and insights on building websites and web applications using Laravel, PHP, React, Vue.js, and modern web technologies.',
                'meta_title' => 'Web Development Articles | Jjuuko Ronald — Laravel Developer Uganda',
                'meta_description' => 'Read web development tutorials and guides by Jjuuko Ronald, a full-stack developer in Kampala, Uganda. Covering Laravel, PHP, React, Vue.js, and more.',
                'sort_order' => 1,
            ],
            [
                'name' => 'Mobile App Development',
                'slug' => 'mobile-app-development',
                'description' => 'Guides and tutorials on building cross-platform mobile applications with Flutter and Dart for Android and iOS, with a focus on East African market needs.',
                'meta_title' => 'Mobile App Development Uganda | Flutter Tutorials — Jjuuko Ronald',
                'meta_description' => 'Flutter and Dart mobile app development tutorials by Jjuuko Ronald, based in Kampala, Uganda. Building apps for Android and iOS across East Africa.',
                'sort_order' => 2,
            ],
            [
                'name' => 'Payments & Integrations',
                'slug' => 'payments-integrations',
                'description' => 'Step-by-step integration guides for African payment systems including MTN Mobile Money, Airtel Money, Flutterwave, and other East African payment APIs.',
                'meta_title' => 'MTN MoMo & Payment Integration Guides Uganda | Jjuuko Ronald',
                'meta_description' => 'Learn how to integrate MTN MoMo, Airtel Money, and other African payment systems into your web and mobile apps. Tutorials by Jjuuko Ronald, Uganda developer.',
                'sort_order' => 3,
            ],
            [
                'name' => 'SEO & Digital Marketing',
                'slug' => 'seo-digital-marketing',
                'description' => 'Practical SEO guides, Google Search Console tutorials, and digital marketing strategies written specifically for Ugandan and East African businesses and developers.',
                'meta_title' => 'SEO Guide Uganda | Google Search Console & Digital Marketing — Jjuuko Ronald',
                'meta_description' => 'SEO and digital marketing tutorials for Ugandan businesses and developers by Jjuuko Ronald. Covering technical SEO, Google tools, and content strategy for East Africa.',
                'sort_order' => 4,
            ],
        ];

        $result = [];
        foreach ($data as $item) {
            $result[$item['slug']] = PostCategory::firstOrCreate(
                ['slug' => $item['slug']],
                $item
            );
        }

        return $result;
    }

    protected function seedTags(): array
    {
        $data = [
            ['name' => 'Laravel', 'slug' => 'laravel'],
            ['name' => 'PHP', 'slug' => 'php'],
            ['name' => 'Flutter', 'slug' => 'flutter'],
            ['name' => 'Dart', 'slug' => 'dart'],
            ['name' => 'React', 'slug' => 'react'],
            ['name' => 'JavaScript', 'slug' => 'javascript'],
            ['name' => 'MySQL', 'slug' => 'mysql'],
            ['name' => 'PostgreSQL', 'slug' => 'postgresql'],
            ['name' => 'REST API', 'slug' => 'rest-api'],
            ['name' => 'MTN MoMo', 'slug' => 'mtn-momo'],
            ['name' => 'Airtel Money', 'slug' => 'airtel-money'],
            ['name' => 'Mobile Money Uganda', 'slug' => 'mobile-money-uganda'],
            ['name' => 'SEO', 'slug' => 'seo'],
            ['name' => 'Google Search Console', 'slug' => 'google-search-console'],
            ['name' => 'Uganda', 'slug' => 'uganda'],
            ['name' => 'East Africa', 'slug' => 'east-africa'],
            ['name' => 'Web Development', 'slug' => 'web-development'],
            ['name' => 'Mobile App', 'slug' => 'mobile-app'],
            ['name' => 'Kampala', 'slug' => 'kampala'],
            ['name' => 'Docker', 'slug' => 'docker'],
            ['name' => 'Tailwind CSS', 'slug' => 'tailwind-css'],
            ['name' => 'Freelancing', 'slug' => 'freelancing'],
            ['name' => 'Firebase', 'slug' => 'firebase'],
            ['name' => 'GitHub Actions', 'slug' => 'github-actions'],
            ['name' => 'SaaS', 'slug' => 'saas'],
            ['name' => 'Website Design', 'slug' => 'website-design'],
            ['name' => 'Technical SEO', 'slug' => 'technical-seo'],
            ['name' => 'Structured Data', 'slug' => 'structured-data'],
        ];

        $result = [];
        foreach ($data as $item) {
            $result[$item['slug']] = Tag::firstOrCreate(
                ['slug' => $item['slug']],
                $item
            );
        }

        return $result;
    }

    protected function seedPosts(array $categories, array $tags): void
    {
        $posts = [
            $this->post1($categories, $tags),
            $this->post2($categories, $tags),
            $this->post3($categories, $tags),
            $this->post4($categories, $tags),
        ];

        foreach ($posts as $postData) {
            $postTags = $postData['tags'];
            unset($postData['tags']);

            $post = Post::firstOrCreate(
                ['slug' => $postData['slug']],
                $postData
            );

            $post->tags()->sync($postTags);
        }
    }

    protected function post1(array $c, array $t): array
    {
        return [
            'post_category_id' => $c['payments-integrations']->id,
            'title' => 'How to Integrate MTN Mobile Money (MoMo) API in Laravel — Uganda Guide',
            'slug' => 'integrate-mtn-mobile-money-momo-api-laravel-uganda',
            'excerpt' => 'A complete step-by-step guide to integrating the MTN Mobile Money (MoMo) Collection API into a Laravel application, written specifically for developers building products in Uganda and East Africa.',
            'meta_title' => 'MTN MoMo API Laravel Integration Uganda | Step-by-Step Guide',
            'meta_description' => 'Learn how to integrate MTN Mobile Money (MoMo) Collection API into your Laravel app in Uganda. Full guide covering sandbox setup, access tokens, payment requests, and callbacks.',
            'meta_keywords' => 'MTN MoMo API Laravel Uganda, mobile money integration Laravel, MTN MoMo PHP, Laravel payment Uganda',
            'og_title' => 'MTN MoMo API Integration in Laravel — Uganda Developer Guide',
            'og_description' => 'Step-by-step guide to integrating MTN Mobile Money into a Laravel application. Built for developers in Uganda and East Africa.',
            'robots' => 'index,follow',
            'schema_type' => 'TechArticle',
            'status' => 'published',
            'published_at' => Carbon::now()->subDays(5),
            'is_featured' => true,
            'sitemap_priority' => 0.9,
            'sitemap_changefreq' => 'monthly',
            'include_in_sitemap' => true,
            'include_in_feed' => true,
            'author_name' => 'Jjuuko Ronald',
            'featured_image_alt' => 'MTN MoMo API Laravel integration guide for Uganda developers',
            'body' => $this->post1Body(),
            'tags' => [
                $t['laravel']->id,
                $t['php']->id,
                $t['mtn-momo']->id,
                $t['mobile-money-uganda']->id,
                $t['rest-api']->id,
                $t['uganda']->id,
                $t['east-africa']->id,
            ],
        ];
    }

    protected function post1Body(): string
    {
        return <<<'HTML'
<p>If you are building a web application or SaaS product in Uganda, accepting payments via MTN Mobile Money is not optional — it is essential. MTN MoMo dominates mobile payments in Uganda with millions of active wallets. This guide walks you through integrating the MTN MoMo Collection API into a Laravel application from scratch, using the sandbox environment first, then going live.</p>

<p>I have integrated MoMo into multiple Laravel projects for clients in Kampala and across Uganda, and this guide covers every mistake I made so you do not have to repeat them.</p>

<h2>What You Will Build</h2>

<p>By the end of this guide, your Laravel app will be able to:</p>
<ul>
  <li>Send a payment request to a customer's MTN mobile number</li>
  <li>Receive a callback webhook when the payment is confirmed or fails</li>
  <li>Poll the transaction status manually as a fallback</li>
  <li>Handle all error states gracefully</li>
</ul>

<h2>Prerequisites</h2>

<ul>
  <li>Laravel 10 or 11 (this guide uses Laravel 11)</li>
  <li>PHP 8.2+</li>
  <li>Composer installed</li>
  <li>An MTN MoMo Developer account at <strong>momodeveloper.mtn.com</strong></li>
  <li>A publicly accessible callback URL (use ngrok for local development)</li>
</ul>

<h2>Step 1: Register on MTN MoMo Developer Portal</h2>

<p>Go to <strong>momodeveloper.mtn.com</strong> and create an account. Once logged in, subscribe to the <strong>Collection</strong> product under your sandbox environment. You will receive a <strong>Primary Key</strong> (also called Subscription Key or Ocp-Apim-Subscription-Key). Save this — you will need it for every API call.</p>

<h2>Step 2: Create an API User and API Key</h2>

<p>The MoMo sandbox does not automatically generate an API User. You must create one manually via the API. Run this in your terminal, replacing <code>YOUR_SUBSCRIPTION_KEY</code> and <code>YOUR_CALLBACK_URL</code>:</p>

<pre><code>curl -X POST \
  "https://sandbox.momodeveloper.mtn.com/v1_0/apiuser" \
  -H "Content-Type: application/json" \
  -H "X-Reference-Id: $(uuidgen)" \
  -H "Ocp-Apim-Subscription-Key: YOUR_SUBSCRIPTION_KEY" \
  -d '{"providerCallbackHost": "YOUR_CALLBACK_URL"}'</code></pre>

<p>Note the UUID you used in <code>X-Reference-Id</code> — that becomes your <strong>API User ID</strong>. Then generate an API key for that user:</p>

<pre><code>curl -X POST \
  "https://sandbox.momodeveloper.mtn.com/v1_0/apiuser/YOUR_API_USER_ID/apikey" \
  -H "Ocp-Apim-Subscription-Key: YOUR_SUBSCRIPTION_KEY"</code></pre>

<p>The response contains your <code>apiKey</code>. You now have three credentials: Subscription Key, API User ID, and API Key.</p>

<h2>Step 3: Add Credentials to .env</h2>

<p>Add these to your Laravel <code>.env</code> file:</p>

<pre><code>MOMO_SUBSCRIPTION_KEY=your_subscription_key_here
MOMO_API_USER=your_api_user_id_here
MOMO_API_KEY=your_api_key_here
MOMO_ENVIRONMENT=sandbox
MOMO_CURRENCY=UGX
MOMO_BASE_URL=https://sandbox.momodeveloper.mtn.com</code></pre>

<h2>Step 4: Create the MoMo Service Class</h2>

<p>Create <code>app/Services/MomoService.php</code>:</p>

<pre><code>&lt;?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use Exception;

class MomoService
{
    protected string $baseUrl;
    protected string $subscriptionKey;
    protected string $apiUser;
    protected string $apiKey;
    protected string $environment;
    protected string $currency;

    public function __construct()
    {
        $this->baseUrl        = config('services.momo.base_url');
        $this->subscriptionKey = config('services.momo.subscription_key');
        $this->apiUser        = config('services.momo.api_user');
        $this->apiKey         = config('services.momo.api_key');
        $this->environment    = config('services.momo.environment', 'sandbox');
        $this->currency       = config('services.momo.currency', 'UGX');
    }

    /**
     * Get an access token for the Collections API.
     */
    public function getAccessToken(): string
    {
        $response = Http::withBasicAuth($this->apiUser, $this->apiKey)
            ->withHeaders([
                'Ocp-Apim-Subscription-Key' => $this->subscriptionKey,
            ])
            ->post($this->baseUrl . '/collection/token/');

        if (!$response->successful()) {
            throw new Exception('MoMo token request failed: ' . $response->body());
        }

        return $response->json('access_token');
    }

    /**
     * Request payment from a mobile number.
     */
    public function requestToPay(
        string $phoneNumber,
        float $amount,
        string $externalId,
        string $payerMessage = 'Payment',
        string $payeeNote = 'Payment received'
    ): string {
        $token       = $this->getAccessToken();
        $referenceId = (string) Str::uuid();

        $response = Http::withToken($token)
            ->withHeaders([
                'X-Reference-Id'            => $referenceId,
                'X-Target-Environment'      => $this->environment,
                'Ocp-Apim-Subscription-Key' => $this->subscriptionKey,
                'X-Callback-Url'            => route('momo.callback'),
            ])
            ->post($this->baseUrl . '/collection/v1_0/requesttopay', [
                'amount'       => (string) $amount,
                'currency'     => $this->currency,
                'externalId'   => $externalId,
                'payer'        => [
                    'partyIdType' => 'MSISDN',
                    'partyId'     => $phoneNumber,
                ],
                'payerMessage' => $payerMessage,
                'payeeNote'    => $payeeNote,
            ]);

        if ($response->status() !== 202) {
            throw new Exception('MoMo payment request failed: ' . $response->body());
        }

        return $referenceId;
    }

    /**
     * Check the status of a payment request.
     */
    public function getTransactionStatus(string $referenceId): array
    {
        $token = $this->getAccessToken();

        $response = Http::withToken($token)
            ->withHeaders([
                'X-Target-Environment'      => $this->environment,
                'Ocp-Apim-Subscription-Key' => $this->subscriptionKey,
            ])
            ->get($this->baseUrl . '/collection/v1_0/requesttopay/' . $referenceId);

        if (!$response->successful()) {
            throw new Exception('MoMo status check failed: ' . $response->body());
        }

        return $response->json();
    }
}</code></pre>

<h2>Step 5: Add to config/services.php</h2>

<pre><code>'momo' => [
    'base_url'         => env('MOMO_BASE_URL', 'https://sandbox.momodeveloper.mtn.com'),
    'subscription_key' => env('MOMO_SUBSCRIPTION_KEY'),
    'api_user'         => env('MOMO_API_USER'),
    'api_key'          => env('MOMO_API_KEY'),
    'environment'      => env('MOMO_ENVIRONMENT', 'sandbox'),
    'currency'         => env('MOMO_CURRENCY', 'UGX'),
],</code></pre>

<h2>Step 6: Create the Payment Controller</h2>

<pre><code>&lt;?php

namespace App\Http\Controllers;

use App\Services\MomoService;
use Illuminate\Http\Request;

class MomoController extends Controller
{
    public function __construct(protected MomoService $momo) {}

    public function initiatePayment(Request $request)
    {
        $validated = $request->validate([
            'phone'  => 'required|string|regex:/^256[0-9]{9}$/',
            'amount' => 'required|numeric|min:500',
        ]);

        try {
            $referenceId = $this->momo->requestToPay(
                phoneNumber: $validated['phone'],
                amount:      $validated['amount'],
                externalId:  uniqid('TXN_'),
                payerMessage: 'Payment to ' . config('app.name'),
            );

            return response()->json([
                'status'      => 'pending',
                'reference'   => $referenceId,
                'message'     => 'Payment request sent. Ask the customer to approve on their phone.',
            ]);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()], 500);
        }
    }

    public function callback(Request $request)
    {
        $payload = $request->all();

        \Log::info('MoMo callback received', $payload);

        return response()->json(['received' => true]);
    }

    public function checkStatus(string $referenceId)
    {
        $status = $this->momo->getTransactionStatus($referenceId);
        return response()->json($status);
    }
}</code></pre>

<h2>Step 7: Register Routes</h2>

<pre><code>Route::post('/payments/momo/initiate',    [MomoController::class, 'initiatePayment']);
Route::post('/payments/momo/callback',    [MomoController::class, 'callback'])->name('momo.callback');
Route::get('/payments/momo/status/{ref}', [MomoController::class, 'checkStatus']);
</code></pre>

<p>Make sure the callback route is excluded from CSRF middleware in <code>bootstrap/app.php</code>:</p>

<pre><code>->withMiddleware(function (Middleware $middleware) {
    $middleware->validateCsrfTokens(except: [
        'payments/momo/callback',
    ]);
})</code></pre>

<h2>Going Live</h2>

<p>To switch from sandbox to production, update your <code>.env</code>:</p>

<pre><code>MOMO_BASE_URL=https://proxy.momoapi.mtn.com
MOMO_ENVIRONMENT=mtncameroon  # change to your country code, e.g. mtnuganda
</code></pre>

<p>Contact MTN Uganda's MoMo API team to get your production credentials and whitelist your server IP for the disbursement API if you need to send money out.</p>

<h2>Common Errors in Uganda</h2>

<ul>
  <li><strong>401 Unauthorized</strong>: Your subscription key is wrong or the API user was created with a different key. Regenerate your API key.</li>
  <li><strong>500 on callback</strong>: Ensure your callback URL is publicly accessible. Use ngrok in development: <code>ngrok http 8000</code>.</li>
  <li><strong>FAILED status with reason PAYER_NOT_FOUND</strong>: The phone number format is wrong. MTN Uganda numbers must start with <code>25677</code> or <code>25678</code>, not <code>0</code>.</li>
  <li><strong>Currency mismatch</strong>: In sandbox, use <code>EUR</code> for testing amounts. In production, use <code>UGX</code>.</li>
</ul>

<h2>Final Notes</h2>

<p>MTN MoMo integration in Laravel is straightforward once you understand the three-credential setup. The most confusing part for most Ugandan developers is that you must create the API User manually in sandbox — it is not auto-generated when you register. Follow the steps above exactly and you will have a working integration in under an hour.</p>

<p>If you are also accepting Airtel Money, the Airtel Money Africa API follows a similar OAuth2 flow and I will cover that in a follow-up guide.</p>

<p>Have questions about this integration? <a href="/contact">Reach out</a> — I have built this for multiple Ugandan projects and can help you implement it for your specific use case.</p>
HTML;
    }

    protected function post2(array $c, array $t): array
    {
        return [
            'post_category_id' => $c['mobile-app-development']->id,
            'title' => 'How to Build a Flutter App for Android in Uganda — From Setup to Play Store',
            'slug' => 'build-flutter-app-android-uganda-setup-to-play-store',
            'excerpt' => 'A practical guide to building and publishing your first Flutter Android app in Uganda — covering environment setup, writing your first screen, and submitting to Google Play Store from Kampala.',
            'meta_title' => 'Build a Flutter Android App in Uganda | Setup to Play Store Guide',
            'meta_description' => 'Learn how to build a Flutter Android app in Uganda, from installing Flutter on Windows or Linux to publishing on Google Play Store. Written for Ugandan developers by Jjuuko Ronald.',
            'meta_keywords' => 'Flutter app Uganda, build Android app Uganda, Flutter developer Kampala, mobile app development Uganda, Flutter setup Windows',
            'og_title' => 'Flutter Android App Development Guide — Uganda',
            'og_description' => 'From zero to Play Store: a practical Flutter Android guide written for developers in Uganda and East Africa.',
            'robots' => 'index,follow',
            'schema_type' => 'TechArticle',
            'status' => 'published',
            'published_at' => Carbon::now()->subDays(12),
            'is_featured' => true,
            'sitemap_priority' => 0.9,
            'sitemap_changefreq' => 'monthly',
            'include_in_sitemap' => true,
            'include_in_feed' => true,
            'author_name' => 'Jjuuko Ronald',
            'featured_image_alt' => 'Flutter Android app development guide for developers in Uganda',
            'body' => $this->post2Body(),
            'tags' => [
                $t['flutter']->id,
                $t['dart']->id,
                $t['mobile-app']->id,
                $t['uganda']->id,
                $t['east-africa']->id,
                $t['kampala']->id,
                $t['firebase']->id,
            ],
        ];
    }

    protected function post2Body(): string
    {
        return <<<'HTML'
<p>Mobile app development is one of the most in-demand skills in Uganda right now. With over 80% of internet users in Uganda accessing the web via smartphones, businesses are actively looking for developers who can build Android apps that work well on affordable devices and low-bandwidth connections. Flutter, Google's cross-platform framework, is my go-to tool for this — and this guide is everything you need to get from zero to a published app on Google Play Store.</p>

<p>I have been building Flutter apps since 2022, with clients in Kampala, and this is the guide I wish I had when I started.</p>

<h2>Why Flutter for Uganda?</h2>

<p>Flutter compiles to native ARM code, which means apps run fast even on entry-level Android devices — the kind most people in Uganda and East Africa use. A single codebase covers Android and iOS, cutting development time in half. The widget library is rich and offline-first patterns are well-supported, which matters when your users are on Airtel or MTN data that drops frequently.</p>

<h2>Step 1: Install Flutter on Windows</h2>

<p>Most developers in Uganda work on Windows. Here is the exact setup:</p>

<ol>
  <li>Download the Flutter SDK from <strong>flutter.dev/docs/get-started/install/windows</strong></li>
  <li>Extract to <code>C:\flutter</code> (avoid paths with spaces)</li>
  <li>Add <code>C:\flutter\bin</code> to your Windows PATH environment variable</li>
  <li>Run <code>flutter doctor</code> in Command Prompt and fix each ❌ it shows</li>
</ol>

<p>For Linux (Ubuntu, which I use on my development machine):</p>

<pre><code>sudo snap install flutter --classic
flutter doctor</code></pre>

<h2>Step 2: Install Android Studio</h2>

<p>Download Android Studio from <strong>developer.android.com/studio</strong>. During installation, make sure the Android SDK, Android SDK Platform-Tools, and Android Virtual Device components are selected.</p>

<p>After installation, run:</p>

<pre><code>flutter doctor --android-licenses</code></pre>

<p>Accept all licenses. This step trips up many beginners in Uganda — do not skip it.</p>

<h2>Step 3: Create Your First Flutter Project</h2>

<pre><code>flutter create my_ugandan_app
cd my_ugandan_app
flutter run</code></pre>

<p>This launches the default counter app on your emulator or connected Android phone. If you are using a physical device (recommended — it is faster than emulators on most Ugandan developer hardware), enable USB Debugging in your phone's Developer Options first.</p>

<h2>Step 4: Understand the Project Structure</h2>

<p>The important folders:</p>

<ul>
  <li><code>lib/</code> — all your Dart code lives here. <code>main.dart</code> is the entry point.</li>
  <li><code>android/</code> — Android-specific config. You will touch this for permissions and Play Store metadata.</li>
  <li><code>pubspec.yaml</code> — your dependencies file. Like <code>composer.json</code> for PHP.</li>
  <li><code>assets/</code> — images, fonts, and other static files.</li>
</ul>

<h2>Step 5: Build a Simple Home Screen</h2>

<p>Replace the contents of <code>lib/main.dart</code> with a clean starting point:</p>

<pre><code>import 'package:flutter/material.dart';

void main() {
  runApp(const MyApp());
}

class MyApp extends StatelessWidget {
  const MyApp({super.key});

  @override
  Widget build(BuildContext context) {
    return MaterialApp(
      title: 'My App',
      debugShowCheckedModeBanner: false,
      theme: ThemeData(
        colorScheme: ColorScheme.fromSeed(seedColor: const Color(0xFF1A56DB)),
        useMaterial3: true,
      ),
      home: const HomeScreen(),
    );
  }
}

class HomeScreen extends StatelessWidget {
  const HomeScreen({super.key});

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        title: const Text('Welcome'),
        backgroundColor: Theme.of(context).colorScheme.primary,
        foregroundColor: Colors.white,
      ),
      body: const Center(
        child: Text(
          'Hello, Uganda!',
          style: TextStyle(fontSize: 24, fontWeight: FontWeight.bold),
        ),
      ),
    );
  }
}</code></pre>

<h2>Step 6: Key Packages Every Ugandan App Needs</h2>

<p>Add these to <code>pubspec.yaml</code> under <code>dependencies</code>:</p>

<pre><code>dependencies:
  flutter:
    sdk: flutter
  http: ^1.2.0           # API calls to your Laravel backend
  provider: ^6.1.0       # State management
  shared_preferences: ^2.2.0  # Local storage (remember login sessions)
  flutter_secure_storage: ^9.0.0  # Store tokens securely
  cached_network_image: ^3.3.0    # Images with offline caching
  connectivity_plus: ^6.0.0       # Detect network status (critical for Uganda)
  flutter_svg: ^2.0.0             # SVG support</code></pre>

<p>Run <code>flutter pub get</code> to install them.</p>

<h2>Step 7: Handle Offline Gracefully</h2>

<p>Network reliability in Uganda means your app must handle offline states gracefully. Add a connectivity check to your app:</p>

<pre><code>import 'package:connectivity_plus/connectivity_plus.dart';

Future&lt;bool&gt; isConnected() async {
  final result = await Connectivity().checkConnectivity();
  return result != ConnectivityResult.none;
}

// Use it before API calls:
if (!await isConnected()) {
  ScaffoldMessenger.of(context).showSnackBar(
    const SnackBar(content: Text('No internet connection. Please check your data.')),
  );
  return;
}</code></pre>

<h2>Step 8: Connect to Your Laravel Backend</h2>

<p>Create <code>lib/services/api_service.dart</code>:</p>

<pre><code>import 'package:http/http.dart' as http;
import 'dart:convert';

class ApiService {
  static const String baseUrl = 'https://yourlaravelapp.com/api';

  static Future&lt;Map&lt;String, dynamic&gt;&gt; get(String endpoint, String token) async {
    final response = await http.get(
      Uri.parse('$baseUrl/$endpoint'),
      headers: {
        'Authorization': 'Bearer $token',
        'Accept': 'application/json',
      },
    );

    if (response.statusCode == 200) {
      return jsonDecode(response.body);
    } else {
      throw Exception('API error: ${response.statusCode}');
    }
  }
}</code></pre>

<h2>Step 9: Build the Release APK</h2>

<p>Before building for release, update your app details in <code>android/app/build.gradle</code>:</p>

<pre><code>android {
    defaultConfig {
        applicationId "com.yourname.yourapp"
        minSdk 21
        targetSdk 34
        versionCode 1
        versionName "1.0.0"
    }
}</code></pre>

<p>Generate a signing key (run this once):</p>

<pre><code>keytool -genkey -v -keystore ~/my-app-key.jks -keyalg RSA -keysize 2048 -validity 10000 -alias my-key</code></pre>

<p>Then build:</p>

<pre><code>flutter build appbundle</code></pre>

<p>This creates an <code>.aab</code> file in <code>build/app/outputs/bundle/release/</code> — that is what you upload to Google Play.</p>

<h2>Step 10: Publish to Google Play Store</h2>

<ol>
  <li>Go to <strong>play.google.com/console</strong> and create a developer account. The one-time fee is $25 USD (about UGX 93,000). Pay via Visa card or Google Pay.</li>
  <li>Create a new app, fill in the store listing (title, description, screenshots)</li>
  <li>Upload your <code>.aab</code> file under Production → Releases</li>
  <li>Complete the content rating questionnaire</li>
  <li>Submit for review — Google reviews typically take 1–3 days</li>
</ol>

<h2>Common Issues for Ugandan Developers</h2>

<ul>
  <li><strong>Play Console payment</strong>: If your Ugandan Visa card is declined, try a Equity Bank or Stanbic Bank Visa. Some developers use a relative's card abroad.</li>
  <li><strong>Slow emulator</strong>: Enable HAXM acceleration in Android Studio, or just use a physical phone — much faster on typical Uganda developer hardware.</li>
  <li><strong>Build takes too long</strong>: Add <code>org.gradle.daemon=true</code> and <code>org.gradle.parallel=true</code> to <code>android/gradle.properties</code>.</li>
</ul>

<h2>Next Steps</h2>

<p>Once your app is live, explore adding Firebase for push notifications, Flutter's <code>geolocator</code> package for location features, and MoMo/Airtel Money payments. These are the most requested features by Ugandan business clients.</p>

<p>Need help building a Flutter app for your business or client in Uganda? <a href="/contact">Get in touch</a> — I build production Flutter apps for clients across Kampala and East Africa.</p>
HTML;
    }

    protected function post3(array $c, array $t): array
    {
        return [
            'post_category_id' => $c['web-development']->id,
            'title' => 'How to Build a Laravel REST API for a Flutter Mobile App',
            'slug' => 'build-laravel-rest-api-flutter-mobile-app',
            'excerpt' => 'A complete guide to building a production-ready Laravel REST API that powers a Flutter mobile app — covering authentication, resource transformations, pagination, error handling, and deployment.',
            'meta_title' => 'Laravel REST API for Flutter App | Full Guide — Jjuuko Ronald Uganda',
            'meta_description' => 'Learn how to build a Laravel REST API backend for a Flutter mobile app. Covers Sanctum auth, API resources, pagination, error handling, and deploying to a live server.',
            'meta_keywords' => 'Laravel REST API Flutter, Laravel API backend Uganda, Laravel Sanctum mobile, build Laravel API PHP, Laravel Flutter backend',
            'og_title' => 'Building a Laravel REST API for Flutter — Complete Guide',
            'og_description' => 'How to build and connect a Laravel REST API to a Flutter mobile app. From authentication to deployment.',
            'robots' => 'index,follow',
            'schema_type' => 'TechArticle',
            'status' => 'published',
            'published_at' => Carbon::now()->subDays(20),
            'is_featured' => false,
            'sitemap_priority' => 0.85,
            'sitemap_changefreq' => 'monthly',
            'include_in_sitemap' => true,
            'include_in_feed' => true,
            'author_name' => 'Jjuuko Ronald',
            'featured_image_alt' => 'Building a Laravel REST API for a Flutter mobile app',
            'body' => $this->post3Body(),
            'tags' => [
                $t['laravel']->id,
                $t['php']->id,
                $t['flutter']->id,
                $t['rest-api']->id,
                $t['mysql']->id,
                $t['web-development']->id,
                $t['github-actions']->id,
            ],
        ];
    }

    protected function post3Body(): string
    {
        return <<<'HTML'
<p>Almost every Flutter app needs a backend. Whether you are building an e-commerce platform, a delivery app, or a business management system for a client in Uganda, your mobile app will need to fetch data, authenticate users, and process transactions through a server. Laravel is my first choice for this backend — it is fast to build with, has excellent built-in authentication, and deploys cleanly to any Linux server.</p>

<p>This guide covers building a real, production-ready REST API in Laravel that you can connect to a Flutter frontend.</p>

<h2>Project Setup</h2>

<pre><code>composer create-project laravel/laravel my-api
cd my-api
php artisan key:generate</code></pre>

<p>Configure your database in <code>.env</code>:</p>

<pre><code>DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=my_api_db
DB_USERNAME=root
DB_PASSWORD=secret</code></pre>

<h2>Authentication with Laravel Sanctum</h2>

<p>Sanctum is the right choice for mobile app authentication in Laravel. It issues plain tokens — simpler and more reliable than Passport's OAuth2 for mobile clients.</p>

<pre><code>composer require laravel/sanctum
php artisan vendor:publish --provider="Laravel\Sanctum\SanctumServiceProvider"
php artisan migrate</code></pre>

<p>Update <code>app/Models/User.php</code> to use the <code>HasApiTokens</code> trait:</p>

<pre><code>use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    // ...
}</code></pre>

<p>Add Sanctum middleware to your api routes in <code>bootstrap/app.php</code>:</p>

<pre><code>->withMiddleware(function (Middleware $middleware) {
    $middleware->api(append: [
        \Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful::class,
    ]);
})</code></pre>

<h2>Auth Controller</h2>

<p>Create <code>app/Http/Controllers/Api/AuthController.php</code>:</p>

<pre><code>&lt;?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validated = $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = User::create([
            'name'     => $validated['name'],
            'email'    => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);

        $token = $user->createToken('mobile-app')->plainTextToken;

        return response()->json([
            'user'  => $user,
            'token' => $token,
        ], 201);
    }

    public function login(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }

        $token = $user->createToken('mobile-app')->plainTextToken;

        return response()->json(['user' => $user, 'token' => $token]);
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return response()->json(['message' => 'Logged out successfully']);
    }

    public function me(Request $request)
    {
        return response()->json($request->user());
    }
}</code></pre>

<h2>API Resources for Clean Responses</h2>

<p>Never return raw Eloquent models from your API. Use API Resources to control exactly what data Flutter receives:</p>

<pre><code>php artisan make:resource UserResource</code></pre>

<p>Edit <code>app/Http/Resources/UserResource.php</code>:</p>

<pre><code>public function toArray(Request $request): array
{
    return [
        'id'         => $this->id,
        'name'       => $this->name,
        'email'      => $this->email,
        'avatar'     => $this->avatar_url,
        'created_at' => $this->created_at->toIso8601String(),
    ];
}</code></pre>

<h2>Consistent Error Handling</h2>

<p>Flutter needs predictable JSON responses, even for errors. Add this to <code>bootstrap/app.php</code>:</p>

<pre><code>->withExceptions(function (Exceptions $exceptions) {
    $exceptions->render(function (\Illuminate\Validation\ValidationException $e, $request) {
        if ($request->expectsJson()) {
            return response()->json([
                'status'  => 'error',
                'message' => 'Validation failed',
                'errors'  => $e->errors(),
            ], 422);
        }
    });

    $exceptions->render(function (\Illuminate\Auth\AuthenticationException $e, $request) {
        if ($request->expectsJson()) {
            return response()->json([
                'status'  => 'error',
                'message' => 'Unauthenticated.',
            ], 401);
        }
    });
})</code></pre>

<h2>Pagination That Works Well with Flutter</h2>

<p>Always use cursor pagination for mobile apps — it performs better on large datasets and avoids count queries:</p>

<pre><code>public function index()
{
    $items = Item::latest()
                 ->cursorPaginate(20);

    return ItemResource::collection($items);
}</code></pre>

<p>Flutter reads the <code>links.next</code> field to load the next page.</p>

<h2>API Routes</h2>

<p>In <code>routes/api.php</code>:</p>

<pre><code>use App\Http\Controllers\Api\AuthController;

// Public routes
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login',    [AuthController::class, 'login']);

// Protected routes
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/me',      [AuthController::class, 'me']);

    // Add your app's resource routes here
    Route::apiResource('items', ItemController::class);
});</code></pre>

<h2>Deploying to a VPS in Uganda</h2>

<p>For Laravel APIs I typically deploy to DigitalOcean or a Ugandan VPS (Camellia Networks and IS.UG both offer good hosting). Basic deployment checklist:</p>

<pre><code># On the server
git clone https://github.com/yourusername/my-api.git
cd my-api
composer install --no-dev --optimize-autoloader
cp .env.example .env
php artisan key:generate
php artisan migrate --force
php artisan config:cache
php artisan route:cache
php artisan optimize</code></pre>

<p>Set up Nginx to point to <code>/public</code> and configure SSL with Certbot (free). Your Flutter app then makes requests to <code>https://api.yourdomain.com</code>.</p>

<h2>Connecting Flutter to the API</h2>

<p>In Flutter, store the token after login and attach it to every request:</p>

<pre><code>// After login
final prefs = await SharedPreferences.getInstance();
await prefs.setString('auth_token', response['token']);

// On every API call
final token = prefs.getString('auth_token');
final response = await http.get(
  Uri.parse('https://api.yourdomain.com/api/me'),
  headers: {
    'Authorization': 'Bearer $token',
    'Accept': 'application/json',
  },
);</code></pre>

<h2>Summary</h2>

<p>Laravel + Sanctum gives you a secure, fast, and maintainable API backend for any Flutter app. The combination powers most of the mobile-first products I build for clients in Uganda. The key principles are: use Resources for every response, handle errors consistently, use cursor pagination, and deploy with <code>optimize</code> commands for speed.</p>

<p>Building a mobile app and need a Laravel backend? <a href="/contact">Contact me</a> — I build and maintain Laravel APIs for Flutter apps for clients across Uganda and East Africa.</p>
HTML;
    }

    protected function post4(array $c, array $t): array
    {
        return [
            'post_category_id' => $c['seo-digital-marketing']->id,
            'title' => 'Technical SEO for Ugandan Websites — A Developer\'s Complete Guide',
            'slug' => 'technical-seo-ugandan-websites-developers-guide',
            'excerpt' => 'A developer\'s guide to technical SEO written specifically for websites targeting Uganda and East Africa — covering site speed on African networks, structured data, local SEO signals, Google Search Console, and AI search visibility.',
            'meta_title' => 'Technical SEO Uganda | How to Rank Your Website in Kampala & East Africa',
            'meta_description' => 'A complete technical SEO guide for Ugandan websites. Learn how to rank on Google Uganda with structured data, Core Web Vitals, local SEO, and AI search signals. By Jjuuko Ronald, developer in Kampala.',
            'meta_keywords' => 'technical SEO Uganda, SEO Kampala, rank website Uganda, Google Search Console Uganda, local SEO Uganda, website SEO East Africa',
            'og_title' => 'Technical SEO for Uganda — How to Rank Your Website in 2025',
            'og_description' => 'Everything a Ugandan website owner or developer needs to know to rank on Google — written by a developer from Kampala.',
            'robots' => 'index,follow',
            'schema_type' => 'BlogPosting',
            'status' => 'published',
            'published_at' => Carbon::now()->subDays(30),
            'is_featured' => true,
            'sitemap_priority' => 0.9,
            'sitemap_changefreq' => 'monthly',
            'include_in_sitemap' => true,
            'include_in_feed' => true,
            'author_name' => 'Jjuuko Ronald',
            'featured_image_alt' => 'Technical SEO guide for Ugandan websites and developers in Kampala',
            'body' => $this->post4Body(),
            'tags' => [
                $t['seo']->id,
                $t['technical-seo']->id,
                $t['google-search-console']->id,
                $t['structured-data']->id,
                $t['uganda']->id,
                $t['east-africa']->id,
                $t['website-design']->id,
                $t['web-development']->id,
            ],
        ];
    }

    protected function post4Body(): string
    {
        return <<<'HTML'
<p>Most SEO guides are written for businesses in the US, UK, or Nigeria. If you run a website targeting Uganda — whether you are a business owner in Kampala, a developer building for Ugandan clients, or a freelancer trying to get found — many of those guides miss the specific challenges and opportunities that come with ranking in a Ugandan and East African context.</p>

<p>This guide is written from experience. I build and optimise websites for clients across Uganda and this is what actually works, in 2025, for ranking on Google Uganda.</p>

<h2>Understand the Uganda Search Landscape</h2>

<p>Before touching a single meta tag, understand the environment:</p>

<ul>
  <li>Over 80% of searches in Uganda come from mobile devices. Your site must be mobile-first, not just mobile-friendly.</li>
  <li>Average mobile internet speeds in Uganda range from 5–15 Mbps on 4G. Your site must load within 3 seconds on those speeds.</li>
  <li>Most Ugandan users are on MTN or Airtel data. These networks have high latency compared to fibre. Reduce round trips.</li>
  <li>Competition for Ugandan-specific keywords is low compared to global terms. A well-optimised local page can rank page one within 3 months.</li>
</ul>

<h2>Core Web Vitals — The Most Ignored Factor in Uganda</h2>

<p>Google has used Core Web Vitals as a ranking factor since 2021. Most Ugandan websites ignore them entirely — which means fixing yours gives you an immediate competitive edge.</p>

<p>The three metrics:</p>

<ul>
  <li><strong>LCP (Largest Contentful Paint)</strong>: How fast does the main content appear? Target under 2.5 seconds.</li>
  <li><strong>CLS (Cumulative Layout Shift)</strong>: Does the page jump around while loading? Target under 0.1.</li>
  <li><strong>INP (Interaction to Next Paint)</strong>: How fast does the page respond to clicks? Target under 200ms.</li>
</ul>

<p>Check your scores at <strong>pagespeed.insights.google.com</strong>. If you are below 70 on mobile, fixing this is your highest priority SEO task.</p>

<h3>Quick Wins for Speed in Uganda</h3>

<ol>
  <li><strong>Convert images to WebP</strong>. A homepage hero image at 2MB in PNG format will kill your LCP. WebP at 150KB will not. Use tools like Squoosh or, if on Laravel, the spatie/laravel-medialibrary package handles this automatically.</li>
  <li><strong>Add explicit width and height to every image</strong>. This prevents layout shift (CLS).</li>
  <li><strong>Use a CDN</strong>. Cloudflare's free tier serves your static assets from servers closer to Uganda. Enable it.</li>
  <li><strong>Remove unused JavaScript</strong>. Many Ugandan websites load jQuery, Slick Slider, and Bootstrap all at once, none of them optimised. Audit with Chrome DevTools → Coverage.</li>
  <li><strong>Enable server-side caching</strong>. If you are on Laravel, enable response caching. If on WordPress, use WP Super Cache or LiteSpeed Cache.</li>
</ol>

<h2>Structured Data — Your Competitive Advantage</h2>

<p>Structured data (JSON-LD / Schema.org markup) tells Google exactly what your page is about. Almost no Ugandan website implements it correctly, which makes it one of the fastest ways to gain ground over local competitors.</p>

<p>For a business website in Uganda, implement these schema types:</p>

<ul>
  <li><strong>LocalBusiness</strong> or <strong>ProfessionalService</strong>: Your business name, address (Kampala), phone number, opening hours, services offered. This enables Google's Local Pack results.</li>
  <li><strong>WebSite</strong>: Enables the Sitelinks search box in Google results.</li>
  <li><strong>BreadcrumbList</strong>: On every interior page — helps Google understand your site structure.</li>
  <li><strong>BlogPosting</strong> or <strong>TechArticle</strong>: On every blog post — enables rich results like article dates and author info.</li>
  <li><strong>FAQPage</strong>: On service pages with FAQ sections — enables expandable FAQ rich results directly in Google.</li>
</ul>

<p>Here is a minimal LocalBusiness schema for a Kampala business:</p>

<pre><code>&lt;script type="application/ld+json"&gt;
{
  "@context": "https://schema.org",
  "@type": "ProfessionalService",
  "name": "Your Business Name",
  "description": "What your business does, in one sentence.",
  "url": "https://yourdomain.com",
  "telephone": "+256XXXXXXXXX",
  "email": "you@yourdomain.com",
  "address": {
    "@type": "PostalAddress",
    "streetAddress": "Your street, Kampala",
    "addressLocality": "Kampala",
    "addressRegion": "Central Region",
    "addressCountry": "UG"
  },
  "areaServed": ["Uganda", "East Africa"],
  "priceRange": "$$"
}
&lt;/script&gt;</code></pre>

<p>Validate all your structured data at <strong>search.google.com/test/rich-results</strong>.</p>

<h2>Google Search Console — Use It Actively</h2>

<p>Google Search Console is free and it is the most direct signal of what Google thinks about your site. Yet most Ugandan website owners set it up and never log in again. Here is what to check every week:</p>

<ul>
  <li><strong>Performance report</strong>: Which queries is your site appearing for? Which pages get the most clicks? Are there queries with high impressions but low CTR — those pages need better title tags.</li>
  <li><strong>Coverage report</strong>: Are any pages excluded or erroring? Fix noindex tags and crawl errors immediately.</li>
  <li><strong>Core Web Vitals report</strong>: Google will tell you which pages have poor CWV scores and need fixing.</li>
  <li><strong>Sitemaps</strong>: Submit your sitemap at <code>yourdomain.com/sitemap.xml</code> if you have not already. Resubmit after every major content update.</li>
</ul>

<h2>On-Page SEO for Uganda-Targeted Pages</h2>

<p>For every page targeting Ugandan keywords:</p>

<ol>
  <li><strong>Include the location in the page title</strong>: "Web Development Services Uganda" not just "Web Development Services".</li>
  <li><strong>Write the meta description as a value proposition</strong>: "Professional website design for businesses in Kampala and Uganda. Fast, mobile-first, SEO-optimised." — not a keyword dump.</li>
  <li><strong>Use the H1 for the primary keyword</strong>: One H1 per page, matches or closely matches the title.</li>
  <li><strong>Mention nearby cities and regions naturally</strong>: Kampala, Entebbe, Jinja, Gulu, Mbarara — if you serve them. This helps you appear in location-modified searches.</li>
  <li><strong>Internal linking</strong>: Link your service pages to related blog posts and vice versa. Most Ugandan sites have zero internal linking structure.</li>
</ol>

<h2>AI Search Visibility in 2025</h2>

<p>Tools like Perplexity, ChatGPT, Google AI Overviews, and Claude are increasingly the first place people get answers. Being cited by these tools requires different optimisation than traditional Google SEO:</p>

<ul>
  <li><strong>Write direct, factual answers at the top of posts</strong>. AI tools extract and cite the first clear answer they find. Do not bury the answer after three paragraphs of background.</li>
  <li><strong>Use structured data</strong>. LLMs weight pages with complete schema markup more heavily.</li>
  <li><strong>Publish an RSS/Atom feed</strong>. AI crawlers pull RSS feeds regularly.</li>
  <li><strong>Allow AI bots in robots.txt</strong>. Explicitly allow GPTBot, ClaudeBot, and PerplexityBot. Blocking them removes you from their index entirely.</li>
  <li><strong>Create an /llms.txt file</strong>. This is a plain text file that tells AI assistants who you are and what your site covers — a new standard gaining adoption in 2025.</li>
</ul>

<h2>Local SEO — Google Business Profile</h2>

<p>If you have a physical location or serve clients in Kampala, set up a Google Business Profile at <strong>business.google.com</strong>. Fill in everything: category, description, phone, website, opening hours, service area, and photos. Ask every client you work with to leave a Google review. This is the single fastest way to appear in local search results and Google Maps in Uganda.</p>

<h2>Common Ugandan SEO Mistakes</h2>

<ul>
  <li><strong>Keyword stuffing in titles</strong>: "Best Website Design Company Kampala Uganda Website Developer" is a title that will get your site penalised, not ranked. One clear, readable title with one primary keyword.</li>
  <li><strong>Duplicate content across service pages</strong>: Do not create ten pages for "web design Kampala", "web design Uganda", "web design Entebbe" with identical text. Write one strong page with natural location mentions.</li>
  <li><strong>Missing alt text on images</strong>: Every image needs descriptive alt text. This is both an SEO signal and an accessibility requirement.</li>
  <li><strong>No HTTPS</strong>: Google has used HTTPS as a ranking factor since 2014. In 2025, a non-HTTPS site ranks poorly and browsers show security warnings. Get an SSL certificate — they are free via Certbot/Let's Encrypt.</li>
  <li><strong>Slow shared hosting</strong>: If your site takes more than 4 seconds to load, cheap shared hosting is likely the cause. Consider a VPS or at minimum, enable Cloudflare caching.</li>
</ul>

<h2>A Practical 30-Day SEO Action Plan for Uganda</h2>

<p><strong>Week 1:</strong> Fix Core Web Vitals. Compress images, add Cloudflare, enable caching. Get your PageSpeed Insights mobile score above 70.</p>

<p><strong>Week 2:</strong> Add structured data. Implement LocalBusiness/ProfessionalService schema on your homepage and contact page. Add BreadcrumbList to all pages. Validate in Rich Results Test.</p>

<p><strong>Week 3:</strong> Optimise on-page SEO. Audit every page title and meta description. Make sure every page targets a specific keyword phrase that includes Uganda or a Ugandan city.</p>

<p><strong>Week 4:</strong> Build your content foundation. Publish two blog posts targeting questions your clients ask. "How much does website design cost in Uganda?" and "What is the difference between a website and a web application?" are both high-intent, low-competition queries.</p>

<p>SEO is not a one-time task — it is a system. Build the technical foundation correctly and feed it with regular content, and you will see consistent growth in organic traffic within 60–90 days.</p>

<p>Need help auditing or optimising a website for the Ugandan market? <a href="/contact">Get in touch</a> — I offer technical SEO audits and implementation for businesses and developers across Uganda.</p>
HTML;
    }
}
