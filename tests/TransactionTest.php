<?php
namespace TransPay\Test;


use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use TransPay\Transaction;

class TransactionTest extends TestCase {
    use WithFaker;
    protected $instance;

    protected function setUp() : void {
        parent::setUp();
        $this->instance = new Transaction();
    }

    /** @test */
    public function it_sets_sender_id() {
        $senderId = '12345';
        $this->instance->setSenderId($senderId);
        $this->assertEquals($senderId, $this->instance->_data['SenderId']);
    }

    /** @test */
    public function it_sets_receiver_first_name() {
        $firstName = $this->faker->word;
        $this->instance->setReceiverFirstName($firstName);
        $this->assertEquals($firstName, $this->instance->_data['Receiver']['FirstName']);
    }

    /** @test */
    public function it_sets_receiver_last_name() {
        $lastName = $this->faker->word;
        $this->instance->setReceiverLastName($lastName);
        $this->assertEquals($lastName, $this->instance->_data['Receiver']['LastName']);
    }

    /** @test */
    public function it_sets_receiver_first_name_other_language() {
        $firstName = 'وصل';
        $this->instance->setReceiverFirstNameOtherLanguage($firstName);
        $this->assertEquals($firstName, $this->instance->_data['Receiver']['FirstNameOtherLanguage']);
    }

    /** @test */
    public function it_sets_receiver_second_name_other_language() {
        $lastName = 'وصل';
        $this->instance->setReceiverSecondNameOtherLanguage($lastName);
        $this->assertEquals($lastName, $this->instance->_data['Receiver']['SecondNameOtherLanguage']);
    }

    /** @test */
    public function it_sets_receiver_setters() {
        $setters = [
            'SecondName' => $this->faker->word,
            'LastNameOtherLanguage' => $this->faker->word,
            'SecondLastName' => $this->faker->word,
            'SecondLastNameOtherLanguage' => $this->faker->word,
            'FullNameOtherLanguage' => $this->faker->words(3, true),
            'CompleteAddress' => $this->faker->address,
            'CountryIsoCode' => $this->faker->countryCode,
            'MobilePhone' => $this->faker->phoneNumber,
            'IsIndividual' => $this->faker->boolean,
            'Email' => $this->faker->email,
            'ReceiverTypeOfId' => 'PA',
            'ReceiverIdNumber' => '123',
            'Cpf' => '123123123',
            'Notes' => 'asd sd asdas dasd as',
            'NotesOtherLanguage' => '123123asd asdasd sad ',
            'DateOfBirth' => '2019-01-01'
        ];
        $this->settersTesting($setters, 'Receiver');
    }

    public function settersTesting($setters, $key = null) {
        foreach ($setters as $setter => $value) {
            $method = 'set'.$setter;
            $this->instance->$method($value);
            if ($key) {
                $value = $this->instance->_data[$key][$setter];
            } else {
                $value = $this->instance->_data[$setter];
            }
            $this->assertEquals($value, $value);
        }
    }


}
