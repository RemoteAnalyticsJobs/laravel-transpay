<?php

namespace TransPay\Test;

use MongoDB\BSON\Type;
use Tests\TestCase;
use TransPay\Exceptions\InvalidAddressException;
use TransPay\Exceptions\ValueNotValidException;
use TransPay\Sender;
require 'functions.php';

class SenderTest extends TestCase
{
    protected $instance;
    protected function setUp() : void {
        parent::setUp();
        $this->instance = new Sender();
    }

    /** @test */
    public function it_tests_if_sender_id_can_be_created() {
        $response = ['status' => true];
        $httpMock = createHttpMock($response);
        $sender = new Sender($httpMock);
        $res = $sender
                ->create([
                    'name' => 'Sharik Shaikh',
                    'address' => '123 Main st',
                    'phoneMobile' => '1234567890',
                    'TypeOfId' => 'PA',
                    'IdNumber' => '12345677',
                    'DateOfBirth' =>'1994-09-06',
                ]);
        $this->assertTrue($res['status']);
    }

    /** @test */
    public function it_sets_user_full_name() {
        $fullName = 'Sharik Shaikh';
        $this->instance->setFullName($fullName);
        $this->assertEquals($fullName, $this->instance->_data['name']);
    }

    /** @test */
    public function it_sets_user_full_name_as_numbers_and_it_converts_to_string() {
        $fullName = 123123;
        $this->instance->setFullName($fullName);
        $this->assertEquals($fullName, $this->instance->_data['name']);
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
        $this->assertEquals($streetAddress, $this->instance->_data['address']);
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
        $this->assertEquals($phoneNumber, $this->instance->_data['phone']);
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
        $this->assertEquals($idType, $this->instance->_data['idType']);
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
        $this->assertEquals($nameInOtherLanguage, $this->instance->_data['nameOtherLanguage']);
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
        $this->assertEquals($address, $this->instance->_data['addressOtherLanguage']);
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
        $this->assertEquals($phone, $this->instance->_data['phoneHome']);
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
        $this->assertEquals($phone, $this->instance->_data['phoneWork']);
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
        $this->assertEquals($zipCode, $this->instance->_data['zipCode']);
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
        $this->assertEquals($cityId, $this->instance->_data['cityId']);
    }

    /** @test */
    public function it_sets_invalid_city_id() {
        $this->expectException(ValueNotValidException::class);
        $cityId = 'ASDSD';
        $this->instance->setCityId($cityId);
    }

    /** @test */
    public function it_sets_state_id() {
        $stateId = 1;
        $this->instance->setStateId($stateId);
        $this->assertEquals($stateId, $this->instance->_data['stateId']);
    }

    /** @test */
    public function it_sets_invalid_state_id() {
        $this->expectException(ValueNotValidException::class);
        $stateId = 'asdkjdf';
        $this->instance->setStateId($stateId);
    }

    /** @test */
    public function it_sets_country_iso() {
        $countryIsoCode = 'US';
        $this->instance->setCountryIsoCode($countryIsoCode);
        $this->assertEquals($countryIsoCode, $this->instance->_data['countryIsoCode']);
    }

    /** @test */
    public function it_sets_id_number() {
        $idNumber = 'Xx12345yy';
        $this->instance->setIdNumber($idNumber);
        $this->assertEquals($idNumber, $this->instance->_data['idNumber']);
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
        $this->assertEquals($expiryDate, $this->instance->_data['idExpiryDate']);
    }

    /** @test */
    public function is_sets_nationality_iso_code() {
        $isoCountry = 'US';
        $this->instance->setNationalityIsoCode($isoCountry);
        $this->assertEquals($isoCountry, $this->instance->_data['nationalityIsoCode']);
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
        $this->assertEquals($dob, $this->instance->_data['dateOfBirth']);
    }

    /** @test */
    public function it_sets_email_address() {
        $email = 'john@doe.com';
        $this->instance->setEmail($email);
        $this->assertEquals($email, $this->instance->_data['email']);
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
        $this->assertTrue($this->instance->_data['isIndividual']);
    }

    /** @test */
    public function it_sets_occupation() {
        $occupationId = 1;
        $this->instance->setSenderOccupation($occupationId);
        $this->assertEquals($occupationId, $this->instance->_data['senderOccupation']);
    }
}
