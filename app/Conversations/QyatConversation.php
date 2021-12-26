<?php

namespace App\Conversations;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Foundation\Inspiring;
use BotMan\BotMan\Messages\Incoming\Answer;
use BotMan\BotMan\Messages\Outgoing\Question;
use BotMan\BotMan\Messages\Outgoing\Actions\Button;
use BotMan\BotMan\Messages\Conversations\Conversation;
use Debugbar;

class QyatConversation extends Conversation
{

    public function run()
    {
        $this->menu();
    }

    public function menu()
    {
        $question = Question::create('Silahkan Pilih Kebutuhan anda!')->fallback('Tidak Bisa Menampilkan Menu')->callbackId('menu')->addButtons([
            Button::create('Produk')->value('produk'),
            Button::create('About')->value('about'),
            Button::create('Contact')->value('contact'),
            Button::create('Categories')->value('categories'),
        ]);
        $this->ask($question, function (Answer $answer) {
            if ($answer->isInteractiveMessageReply()) {
                switch ($answer->getValue()) {
                    case 'produk':
                        $this->say('Anda Memilih Menu '.$answer->getValue());
                        $this->getProduct();
                        break;
                    case 'about':
                        $this->say('Anda Memilih Menu '.$answer->getValue());
                        $this->getAbout();
                        break;
                    case 'contact':
                        $this->say('Anda Memilih Menu '.$answer->getValue());
                        $this->getContact();
                        break;
                    case 'categories':
                        $this->say('Anda Memilih Menu '.$answer->getValue());
                        $this->getCategories();
                        break;
                    default:
                        # code...
                        break;
                }
            }
        });
    }
    public function getCategories()
    {
        $categories = Category::all();
        $no = 0;
        $slugs = [];
        $buttonArray = [];
        $this->say("Getting Category data...");
        foreach ($categories as $category) {
            $buttonArray[] = Button::create($category->name)->value($category->slug);
            $slugs[] = $category->slug;
            $no += 1;
        }
        $question = Question::create('Silahkan Pilih Kategori yang akan di Lihat!')->fallback('categories')->addButtons($buttonArray);
        $this->ask($question, function (Answer $answer) use ($slugs) {
            if ($answer->isInteractiveMessageReply()) {
                $this->say('Anda Memilih Kategori '.$answer->getValue());

                foreach ($slugs as $slug) {
                    if ($slug == $answer->getValue()) {
                        $this->getCategoryInfo($answer->getValue());
                    }
                }
            }
        });
    }
    public function getCategoryInfo($slug)
    {
        $category = Category::where('slug', $slug)->first();

        $message = sprintf("Kategori yang anda Pilih adalah:".$category->name."\nBerikut Data Kategorinya:\nNama:".$category->name."\nSlug:".$category->slug."\nParent:".$category->parent_name);

        $this->say($message);
    }
    public function getProduct()
    {
        $products = Product::all();
        $buttonArray = [];
        $no = 0;
        $this->say("Getting Product data...");
        foreach ($products as $product) {
            $buttonArray[] = Button::create($product->name)->value($product->slug);
            $no += 1;
        }
        $question = Question::create('Silahkan Pilih Produk yang akan di Lihat!')->fallback('produk')->addButtons($buttonArray);
        $this->ask($question, function (Answer $answer) use ($products) {
            if ($answer->isInteractiveMessageReply()) {
                $this->say('Anda Memilih Produk '.$answer->getValue());
                foreach ($products as $product) {
                    if ($product->slug == $answer->getValue()) {
                        $this->getProductDetail($answer->getValue());
                    }
                }
            }
        });
    }
    public function getProductDetail($slug)
    {
        $product = Product::where('slug', $slug)->first();

        $message = "Produk yang anda pilih adalah: ".$product->slug."\nDengan data:\nName: ".$product->name."\nPrice: ".rupiah($product->price)."\nStok: ".$product->stock."\nKode: ".$product->code;
        $this->say($message);
    }
    public function getAbout()
    {
        $about = "Kami Kedai Kopi Qyat Adalah Sebuah UMKM yang bergerak dibidang Food and Beverages sebagai tempat ngumpul atau nongkrong untuk seluruh golongan masyarakat \r\t\n Jumpai Kami di: Jl. Sultan Ibrahim, Candirejo, Pasir Penyu, Kabupaten Indragiri Hulu, Riau 29353\r\t\n Google Map: https://goo.gl/maps/p2TtZ2YAAxaC2JR88";
        $this->say(sprintf($about));
    }
    public function getContact()
    {

        $contact = "Bot Ini Dibuat Oleh M. Fakhrul Rozi\r\t\nBot Ini Dibuat untuk Kerja Praktik! \r\t\nUntuk Kontak Silahkan Hubungi M. Fakhrul Rozi Melalui:\r\t\nTelegram : @Genjirou\r\t\nNo: 082284678780\r\t\nEmail: m.fakhrulrozi10@gmail.com\r\t\n";
        $this->say(sprintf($contact));
    }
}
