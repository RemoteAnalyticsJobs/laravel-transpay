<?php

namespace TransPay\Test;

use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use TransPay\Exceptions\InvalidAddressException;
use TransPay\Exceptions\ValueNotValidException;
use TransPay\Sender;
require 'functions.php';

class SenderTest extends TestCase
{
    use WithFaker;
    protected $instance;
    protected function setUp() : void {
        parent::setUp();
        $this->instance = new Sender();
    }

    /** @test */
    public function it_tests_if_sender_id_can_be_created() {
        $response = ['status' => true];
        $httpMock = createHttpMock($response);
        $this->withoutExceptionHandling();
        $sender = new Sender($httpMock);
        $res = $sender
            ->setFullName('Sharik Shaikh')
            ->setStreetAddress('123 Main St')
            ->setPhoneNumber('826866355')
            ->setDateOfBirth("2000-10-06T00:00:00")
            ->setCityId(40706)
            ->setStateId('NY')
            ->setIsIndividual(true)
            ->setCountryIsoCode('US')
            ->create();
        $this->assertTrue($res['status']);
    }

    /** @test */
    public function it_sets_user_full_name() {
        $fullName = 'Sharik Shaikh';
        $this->instance->setFullName($fullName);
        $this->assertEquals($fullName, $this->instance->_data['Name']);
    }

    /** @test */
    public function it_sets_user_full_name_as_numbers_and_it_converts_to_string() {
        $fullName = 123123;
        $this->instance->setFullName($fullName);
        $this->assertEquals($fullName, $this->instance->_data['Name']);
    }

    /** @test */
    public function it_sets_full_name_as_empty_string() {
        $this->expectException(ValueNotValidException::class);
        $fullName = '';
        $this->instance->setFullName($fullName);
    }

    /** @test */
    public function it_sets_user_street_address() {
        $streetAddress = '123 Main St';
        $this->instance->setStreetAddress($streetAddress);
        $this->assertEquals($streetAddress, $this->instance->_data['Address']);
    }

    /** @test */
    public function it_sets_invalid_user_street_address() {
        $this->expectException(InvalidAddressException::class);
        $streetAddress = '';
        $this->instance->setStreetAddress($streetAddress);
    }

    /** @test */
    public function it_sets_po_box_address_as_street_address() {
        $this->expectException(InvalidAddressException::class);
        $streetAddress = 'PO BOX 22';
        $this->instance->setStreetAddress($streetAddress);
    }

    /** @test */
    public function it_sets_null_user_street_address() {
        $this->expectException(\TypeError::class);
        $streetAddress = null;
        $this->instance->setStreetAddress($streetAddress);
    }

    /** @test */
    public function it_sets_phone_number_of_the_user() {
        $phoneNumber = '8268663579';
        $this->instance->setPhoneNumber($phoneNumber);
        $this->assertEquals($phoneNumber, $this->instance->_data['PhoneMobile']);
    }

    /** @test */
    public function it_sets_invalid_phone_number_of_the_user() {
        $this->expectException(ValueNotValidException::class);
        $phoneNumber = '';
        $this->instance->setPhoneNumber($phoneNumber);
    }

    /** @test */
    public function it_sets_shortest_invalid_phone_number() {
        $this->expectException(ValueNotValidException::class);
        $phoneNumber = '123';
        $this->instance->setPhoneNumber($phoneNumber);
    }

    /** @test */
    public function it_sets_longer_invalid_phone_number() {
        $this->expectException(ValueNotValidException::class);
        $phoneNumber = '123128946274214123';
        $this->instance->setPhoneNumber($phoneNumber);
    }

    /** @test */
    public function it_sets_id_type() {
        $idType = 'PA';
        $this->instance->setIDType($idType);
        $this->assertEquals($idType, $this->instance->_data['IdType']);
    }

    /** @test */
    public function it_sets_invalid_id_type() {
        $this->expectException(ValueNotValidException::class);
        $idType = 'PASNA';
        $this->instance->setIDType($idType);
    }

    /** @test */
    public function it_sets_name_in_other_language() {
        $nameInOtherLanguage = 'وصل ';
        $this->instance->setNameInOtherLanguage($nameInOtherLanguage);
        $this->assertEquals($nameInOtherLanguage, $this->instance->_data['NameOtherLanguage']);
    }

    /** @test */
    public function it_sets_invalid_name_in_other_language() {
        $this->expectException(ValueNotValidException::class);
        $nameInOtherLanguage = null;
        $this->instance->setNameInOtherLanguage($nameInOtherLanguage);
    }

    /** @test */
    public function it_sets_address_in_other_language() {
        $address = 'وصل ';
        $this->instance->setAddressOtherLanguage($address);
        $this->assertEquals($address, $this->instance->_data['AddressOtherLanguage']);
    }

    /** @test */
    public function it_sets_invalid_address_in_other_language() {
        $this->expectException(ValueNotValidException::class);
        $address = 'asasd hljksadjasdh sjadh asdhj sd sjahdjas hjdd';
        $this->instance->setAddressOtherLanguage($address);
    }

    /** @test */
    public function it_sets_null_Address_in_other_language() {
        $this->expectException(ValueNotValidException::class);
        $address = null;
        $this->instance->setAddressOtherLanguage($address);
    }

    /** @test */
    public function it_sets_home_phone_number() {
        $phone = '3123123123';
        $this->instance->setHomePhone($phone);
        $this->assertEquals($phone, $this->instance->_data['PhoneHome']);
    }

    /** @test */
    public function it_sets_invalid_home_phone_number() {
        $this->expectException(\TypeError::class);
        $phone = null;
        $this->instance->setHomePhone($phone);
    }

    /** @test */
    public function it_sets_longer_invalid_home_phone_number() {
        $this->expectException(ValueNotValidException::class);
        $phone = '1234567890987123';
        $this->instance->setHomePhone($phone);
    }

    /** @test */
    public function it_sets_short_invalid_home_phone_number() {
        $this->expectException(ValueNotValidException::class);
        $phone = '134';
        $this->instance->setHomePhone($phone);
    }

    /** @test */
    public function it_sets_Work_phone_number() {
        $phone = '1234567890';
        $this->instance->setWorkPhone($phone);
        $this->assertEquals($phone, $this->instance->_data['PhoneWork']);
    }

    /** @test */
    public function it_sets_invalid_work_phone_number() {
        $this->expectException(\TypeError::class);
        $phone = null;
        $this->instance->setWorkPhone($phone);
    }

    /** @test */
    public function it_sets_short_work_phone_number() {
        $this->expectException(ValueNotValidException::class);
        $phone = '123';
        $this->instance->setWorkPhone($phone);
    }

    /** @test */
    public function it_sets_longest_work_phone_number() {
        $this->expectException(ValueNotValidException::class);
        $phone = '1233533452343534243452132';
        $this->instance->setWorkPhone($phone);
    }

    /** @test */
    public function it_sets_zip_code() {
        $zipCode = '12345';
        $this->instance->setZipCode($zipCode);
        $this->assertEquals($zipCode, $this->instance->_data['ZipCode']);
    }

    /** @test */
    public function it_sets_zip_code_too_long() {
        $this->expectException(ValueNotValidException::class);
        $zipCode = '12342312312';
        $this->instance->setZipCode($zipCode);
    }

    /** @test */
    public function it_sets_invalid_zip_code() {
        $this->expectException(ValueNotValidException::class);
        $zipCode = '123';
        $this->instance->setZipCode($zipCode);
    }

    /** @test */
    public function it_sets_city_id() {
        $cityId = 1;
        $this->instance->setCityId($cityId);
        $this->assertEquals($cityId, $this->instance->_data['CityId']);
    }

    /** @test */
    public function it_sets_invalid_city_id() {
        $this->expectException(\TypeError::class);
        $cityId = null;
        $this->instance->setCityId($cityId);
    }

    /** @test */
    public function it_sets_state_id() {
        $stateId = "NY";
        $this->instance->setStateId($stateId);
        $this->assertEquals($stateId, $this->instance->_data['StateId']);
    }

    /** @test */
    public function it_sets_invalid_state_id() {
        $this->expectException(\TypeError::class);
        $stateId = null;
        $this->instance->setStateId($stateId);
    }

    /** @test */
    public function it_sets_country_iso() {
        $countryIsoCode = 'US';
        $this->instance->setCountryIsoCode($countryIsoCode);
        $this->assertEquals($countryIsoCode, $this->instance->_data['CountryIsoCode']);
    }

    /** @test */
    public function it_sets_id_number() {
        $idNumber = 'Xx12345yy';
        $this->instance->setIdNumber($idNumber);
        $this->assertEquals($idNumber, $this->instance->_data['IdNumber']);
    }

    /** @test */
    public function it_sets_invalid_id_number() {
        $this->expectException(ValueNotValidException::class);
        $idNumber = '';
        $this->instance->setIdNumber($idNumber);
    }

    /** @test */
    public function it_sets_id_expiry_date() {
        $expiryDate = '2015-11-20T14:25:43.430-00:00';
        $this->instance->setIdExpiryDate($expiryDate);
        $this->assertEquals($expiryDate, $this->instance->_data['IdExpiryDate']);
    }

    /** @test */
    public function is_sets_nationality_iso_code() {
        $isoCountry = 'US';
        $this->instance->setNationalityIsoCode($isoCountry);
        $this->assertEquals($isoCountry, $this->instance->_data['NationalityIsoCode']);
    }

    /** @test */
    public function it_sets_invalid_nationality_iso_code() {
        $this->expectException(ValueNotValidException::class);
        $nationalityIsoCode = 'USA';
        $this->instance->setNationalityIsoCode($nationalityIsoCode);
    }

    /** @test */
    public function it_sets_dob() {
        $dob = '2015-11-20T14:25:43.430-00:00';
        $this->instance->setDateOfBirth($dob);
        $this->assertEquals($dob, $this->instance->_data['DateOfBirth']);
    }

    /** @test */
    public function it_sets_email_address() {
        $email = 'john@doe.com';
        $this->instance->setEmail($email);
        $this->assertEquals($email, $this->instance->_data['Email']);
    }

    /** @test */
    public function it_sets_invalid_email_address() {
        $this->expectException(ValueNotValidException::class);
        $email = 'john';
        $this->instance->setEmail($email);
    }

    /** @test */
    public function it_sets_is_individual() {
        $isIndividual = true;
        $this->instance->setIsIndividual($isIndividual);
        $this->assertTrue($this->instance->_data['IsIndividual']);
    }

    /** @test */
    public function it_sets_occupation() {
        $occupationId = 1;
        $this->instance->setSenderOccupation($occupationId);
        $this->assertEquals($occupationId, $this->instance->_data['SenderOccupation']);
    }

    /** @test */
    public function it_tests_if_validate_returns_no_error() {
        $data = [
            'Name' => $this->faker->word,
            'Address' => $this->faker->streetAddress,
            'PhoneMobile' => $this->faker->phoneNumber,
            'CityId' => $this->faker->city,
            'StateId' => 'FL',
            'CountryIsoCode' => $this->faker->countryCode,
            'IsIndividual' => $this->faker->boolean
        ];
        $res = $this->instance->_validate($data);
        $this->assertCount(0, $res['errors']);
    }

    /** @test */
    public function it_tests_if_validation_fails_and_returns_proper_missing_keys() {
        $data = [
            'Name' => $this->faker->word,
            'Address' => $this->faker->streetAddress,
            'PhoneMobile' => $this->faker->phoneNumber,
            'CountryIsoCode' => $this->faker->countryCode,
            'IsIndividual' => $this->faker->boolean
        ];

        $res = $this->instance->_validate($data);

        $this->assertEquals('Missing required values', $res['message']);
        $this->assertTrue(in_array('StateId', $res['errors']));
        $this->assertTrue(in_array('CityId', $res['errors']));
        $this->assertCount(2, $res['errors']);
    }
}
