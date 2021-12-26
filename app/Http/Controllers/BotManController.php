<?php
namespace App\Http\Controllers;

use BotMan\BotMan\BotMan;
use App\Conversations\ExampleConversation;
use App\Conversations\QyatConversation;
use App\Models\Category;
use BotMan\BotMan\Cache\LaravelCache;
use BotMan\BotMan\BotManFactory;
use BotMan\BotMan\Drivers\DriverManager;
use BotMan\BotMan\Messages\Incoming\Answer;

class BotManController extends Controller
{
    /**
     * Place your BotMan logic here.
     */
    public function handle()
    {
        // Load the driver(s) you want to use
        DriverManager::loadDriver(\BotMan\Drivers\Telegram\TelegramDriver::class);
        //disable debugbar
        app('debugbar')->disable();

        $config = [
            // Your driver-specific configuration
            "telegram" => [
               "token" => env('TELEGRAM_TOKEN'),
            ],
        ];

        $botman = BotManFactory::create($config, new LaravelCache());


        $botman->hears('/start|start|mulai', function (BotMan $bot) {
            $user = $bot->getUser();
            $bot->reply('Assalamualaikum '.$user->getFirstName().' '.$user->getLastName().', Selamat datang di Kedai Kopi Qyat Telegram Bot!. ');
            $bot->startConversation(new QyatConversation());
        })->stopsConversation();

        $botman->hears('/about|about|tentang|/tentang', function (BotMan $bot) {
            $bot->reply(sprintf("Bot Ini Dibuat Oleh M. Fakhrul Rozi\r\t\nBot Ini Dibuat untuk Kerja Praktik! \r\t\nUntuk Kontak Silahkan Hubungi M. Fakhrul Rozi Melalui:\r\t\nTelegram : @Genjirou\r\t\nNo: 082284678780\r\t\nEmail: m.fakhrulrozi10@gmail.com\r\t\n"));
        });
        $botman->hears('/menu|menu', function (BotMan $bot) {
            $bot->startConversation(new QyatConversation(), 'menu');
        })->stopsConversation();



        // $botman->hears('/kitab|kitab', function (BotMan $bot) {
        //     $bot->startConversation(new ExampleConversation());
        // })->stopsConversation();

        // $botman->hears('/lapor|lapor|laporkan', function (BotMan $bot) {
        //     $bot->reply('Silahkan laporkan di email weare@zalabs.my.id . Laporan kamu akan sangat berharga buat kemajuan bot ini.');
        // })->stopsConversation();

        // $botman->hears('/tentang|about|tentang', function (BotMan $bot) {
        //     $bot->reply('HaditsID Telegram Bot By ZaLabs. Mohon maaf jika server terasa lamban, dikarenakan menggunakan free hosting dari Heroku(.)com. Data didapatkan dari https://s.id/zXj6S .');
        // })->stopsConversation();

        $botman->listen();
    }
    public function index()
    {
        $categories = Category::all();
        $answer = 'foods';
        return view('bot.welcome', compact(['categories', 'answer']));
    }
}
