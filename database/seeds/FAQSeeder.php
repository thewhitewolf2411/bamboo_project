<?php

use App\Eloquent\FAQ;
use Illuminate\Database\Seeder;

class FAQSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        #1
        FAQ::create([
            'question' => 'How do I SELL to Bamboo Mobile?',
            'answer' => 'It couldn’t be simpler! Find your mobile device, receive a quote, send to Bamboo mobile for free and wait for your cash! 
            On the small occasion when your device received is not in the stated condition, we will send you a new quote. 
            If you are not happy with the quote we can send the device back to you free of charge.'
        ]);

        #2
        FAQ::create([
            'question' => 'What devices can I sell to Bamboo Mobile?',
            'answer' => 'You can sell any mobile device from Apple to ZTE, both mobile phones and tablets. 
            If your mobile device has no value, we are happy to help recycle the tech for free.'
        ]);

        #3
        FAQ::create([
            'question' => 'How do I find out what my tech/device is worth?',
            'answer' => 'We ask a few questions about the condition of your device. Then with our pricing algorithm a quote for your device is generated. 
            Price offered is based on the accurate description of condition and functionality which we’ll confirm once we’ve received, tested and inspected your device. 
            If the quote is lower after inspection, you still have the choice not to sell to us, and we will send it back to you free of charge. <a href="/sell" class="answer-text link">Find Out Now</a>',
        ]);

        #4
        FAQ::create([
            'question' => 'When do I get paid?',
            'answer' => 'Oh yes, the best part!  Once we have received your device and it has passed all the tests / inspections, we promise we pay you on the same day!!'
        ]);

        #5
        FAQ::create([
            'question' => 'How long do I have to send in my device?',
            'answer' => 'The estimated trade-in value is valid for 14 days, and we encourage you to send the device to us within this timeframe to ensure getting this value. 
            If you require additional time, please contact our support team at info@bamboomobile.co.uk'
        ]);

        #6
        FAQ::create([
            'question' => 'Is my personal data safe?',
            'answer' => 'Absolutely! We will delete data on all devices using accredited software – PhoneCheck'
        ]);

        #7
        FAQ::create([
            'question' => 'What do I need to include with my device?',
            'answer' => 'To keep things easy and simple, we only need your mobile device – no accessories required but we are happy to help recycle these if you send them in.'
        ]);

        #8
        FAQ::create([
            'question' => 'How about if my mobile device is locked to a UK network?',
            'answer' => 'We accept Network locked devices – but if you can request the network to unlock it you may get more cash!'
        ]);

        #9
        FAQ::create([
            'question' => 'What do I do with iCloud?',
            'answer' => 'It would be best if you canIt would be best if you can remove your device from your iCloud account before sending the device to us. 
            This is really quick and easy to do, please <a href="/instructions/icloud" target="_blank" class="answer-text link">click</a> for a simple guide…',
        ]);

        #10
        FAQ::create([
            'question' => 'What do I do with Google lock?',
            'answer' => 'It would be best if you can remove your device from your Google account before sending the device to us. 
            This is really quick and easy to do, please <a href="/instructions/google" target="_blank" class="answer-text link">click</a> for a simple guide…',
        ]);

        #11
        FAQ::create([
            'question' => 'What if my device is reported blocked?',
            'answer' => 'If your device is blocked, it is likely it has been reported lost or stolen. 
            It is illegal for us to purchase any blocked devices. If you are the rightful owner of the device, you will need to contact your service provider,
            insurance company or <a href="CheckMend" class="answer-text link="https://www.checkmend.com">CheckMend</a> to have the device unblocked within 28 days of us notifying you.  
            Once 28 days has elapsed then the device will be destroyed.',
        ]);

        #12
        FAQ::create([
            'question' => 'What if my device is reported AssetWatch?',
            'answer' => 'If your device is reported as AssetWatch, it is likely this device is under contract with a service provider or finance company. 
            In such circumstances you will be required to provide us proof of ownership of the device and pay an administration fee of £15.00 and we will send the device back to you.'
        ]);

        #13
        FAQ::create([
            'question' => 'Any Other Questions?',
            'answer' => 'You can contact us through our <a href="/contact" class="answer-text link">Contact Us</a> Tab or telephone directly – don’t be shy give us a try!'
        ]);
    }
}
