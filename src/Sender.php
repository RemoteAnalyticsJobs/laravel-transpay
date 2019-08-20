<?php
namespace TransPay;


use TransPay\Exceptions\InvalidAddressException;
use TransPay\Exceptions\ValueNotValidException;

class Sender extends TransPayAbstract {

    /** @var array */
    public $_data;

    /** @var array  */
    public static $requiredFields = [
        'Name',
        'Address',
        'PhoneMobile',
        'CityId',
        'StateId',
        'CountryIsoCode',
        'IsIndividual'
    ];

    /**
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function create() {
        $validate = $this->_validate($this->_data);
        if (count($validate['errors']) > 0) {
            return $validate;
        }
//        dd($this->_data);
        $response = $this->_httpClient->request('POST', 'api/transaction/sender', ['json' => $this->_data]);
        return json_decode($response->getBody()->getContents(), true);
    }

    /**
     * @param string $fullName
     * @return Sender
     * @throws ValueNotValidException
     */
    public function setFullName(string $fullName) : Sender {
        if (!$fullName) {
            throw new ValueNotValidException('Invalid Name provided.');
        }
        $this->_data['Name'] = $fullName;
        return $this;
    }

    /**
     * It sets street address of the user
     * @param string $address
     * @return Sender
     * @throws ValueNotValidException
     * @throws InvalidAddressException
     */
    public function setStreetAddress(string $address) : Sender {
        if (!$address || !preg_match('/^[A-Za-z0-9\s]{5,60}$/', $address) || preg_match('/^PO BOX/', $address)) {
            throw new InvalidAddressException('Invalid street address provided. It should not be empty or PO BOX address');
        }
        $this->_data['Address'] = $address;
        return $this;
    }

    /**
     * It sets user's phone number
     * @param string $phone
     * @return Sender
     * @throws ValueNotValidException
     */
    public function setPhoneNumber(string $phone) : Sender {
        if (!$phone || !preg_match('/^[0-9]{7,15}$/', $phone)) {
            throw new ValueNotValidException('Invalid phone number provided.');
        }
        $this->_data['PhoneMobile'] = $phone;
        return $this;
    }

    /**
     * It will set id type of the user
     * @param string $idType
     * @return Sender
     * @throws ValueNotValidException
     */
    public function setIdType(string $idType) : Sender {
        if (!$idType || !preg_match('/^[A-Za-z0-9]{2}$/', $idType)) {
            throw new ValueNotValidException('Invalid ID Type provided');
        }
        $this->_data['IdType'] = $idType;
        return $this;
    }

    /**
     * It will set name in other language
     * @param $name
     * @return Sender
     * @throws ValueNotValidException
     */
    public function setNameInOtherLanguage($name) : Sender {
        if (!$name) {
            throw new ValueNotValidException('Invalid name in other language');
        }
        $this->_data['NameOtherLanguage'] = $name;
        return $this;
    }

    /**
     * It sets address in different language
     * @param $address
     * @return Sender
     * @throws ValueNotValidException
     */
    public function setAddressOtherLanguage($address) : Sender {
        if (!$address || preg_match('/^[A-Za-z0-9\s]{5,60}$/', $address)) {
            throw new ValueNotValidException('Invalid Address in other language');
        }
        $this->_data['AddressOtherLanguage'] = $address;
        return $this;
    }

    /**
     * @param string $phone
     * @return Sender
     * @throws ValueNotValidException
     */
    public function setHomePhone(string $phone): Sender {
        if (!$phone || !preg_match('/^[0-9]{7,15}$/', $phone)) {
            throw new ValueNotValidException('Invalid home phone number provided');
        }
        $this->_data['PhoneHome'] = $phone;
        return $this;
    }

    /**
     * It will set work phone of the sender
     *
     * @param string $phone
     * @return Sender
     * @throws ValueNotValidException
     */
    public function setWorkPhone(string $phone) : Sender {
        if (!$phone || !preg_match('/^[0-9]{7,15}$/', $phone)) {
            throw new ValueNotValidException('Invalid work phone provided');
        }
        $this->_data['PhoneWork'] = $phone;
        return $this;
    }

    /**
     * It will set zip code
     * @param string $zipCode
     * @return Sender
     * @throws ValueNotValidException
     */
    public function setZipCode(string $zipCode) : Sender {
        if (!$zipCode || !preg_match('/^[0-9a-zA-Z\s]{4,7}$/', $zipCode)) {
            throw new ValueNotValidException('Invalid Zip Code provided');
        }

        $this->_data['ZipCode'] = $zipCode;
        return $this;
    }

    /**
     * @param int $cityId
     * @return Sender
     * @throws ValueNotValidException
     */
    public function setCityId(int $cityId) : Sender {
        if (!$cityId || !preg_match('/(?<=\s|^)\d+(?=\s|$)/', $cityId)) {
            throw new ValueNotValidException('Invalid city id');
        }
        $this->_data['CityId'] = $cityId;
        return $this;
    }

    /**
     * It will set state id
     * @param string $stateId
     * @return Sender
     * @throws ValueNotValidException
     */
    public function setStateId(string $stateId) : Sender {
        if (!$stateId || !preg_match('/^[A-Za-z\s]{2,40}$/', $stateId)) {
            throw new ValueNotValidException('Invalid State id');
        }
        $this->_data['StateId'] = $stateId;
        return $this;
    }

    /**
     * It will set ISO country short code
     * @param string $countryIsoCode
     * @return Sender
     * @throws ValueNotValidException
     */
    public function setCountryIsoCode(string $countryIsoCode) : Sender {
        if (!$countryIsoCode || !
            preg_match('/^[A-Za-z]{2}$/', $countryIsoCode)) {
            throw new ValueNotValidException('Country ISO code is not valid');
        }
        $this->_data['CountryIsoCode'] = $countryIsoCode;
        return $this;
    }

    /**
     * @param string $idNumber
     * @return Sender
     * @throws ValueNotValidException
     */
    public function setIdNumber(string $idNumber) : Sender {
        if (!$idNumber || !preg_match('/^[A-Za-z0-9\s]{1,15}$/', $idNumber)) {
            throw new ValueNotValidException('Invalid id number provided');
        }
        $this->_data['IdNumber'] = $idNumber;
        return $this;
    }

    /**
     * @param string $expiryDate
     * @return Sender
     * @throws ValueNotValidException
     */
    public function setIdExpiryDate(string $expiryDate) : Sender {
        if (!$expiryDate) {
            throw new ValueNotValidException('Given expiry date is not valid');
        }
        $this->_data['IdExpiryDate'] = $expiryDate;
        return $this;
    }

    /**
     * @param string $nationalityIsoCode
     * @return Sender
     * @throws ValueNotValidException
     */
    public function setNationalityIsoCode(string $nationalityIsoCode) : Sender {
        if (!$nationalityIsoCode || !preg_match('/^[A-Za-z]{2}$/', $nationalityIsoCode)) {
            throw new ValueNotValidException('Given value for ISO code is not valid');
        }
        $this->_data['NationalityIsoCode'] = $nationalityIsoCode;
        return $this;
    }

    /**
     * @param string $dob
     * @return Sender
     * @throws ValueNotValidException
     */
    public function setDateOfBirth(string $dob) : Sender {
        if (!$dob) {
            throw new ValueNotValidException('Given date of birth is not provided');
        }
        $this->_data['DateOfBirth'] = $dob;
        return $this;
    }

    /**
     * @param string $email
     * @return Sender
     * @throws ValueNotValidException
     */
    public function setEmail(string $email) : Sender {
        if (!$email || !preg_match('/^[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/', $email))  {
            throw new ValueNotValidException('Given email address is not valid');
        }
        $this->_data['Email'] = $email;
        return $this;
    }

    /**
     * @param bool $isIndividual
     * @return Sender
     */
    public function setIsIndividual(bool $isIndividual) : Sender {
        $this->_data['IsIndividual'] = $isIndividual;
        return $this;
    }

    /**
     * @param int $occupationId
     * @return Sender
     * @throws ValueNotValidException
     */
    public function setSenderOccupation(int $occupationId) : Sender {
        if (!$occupationId) {
            throw new ValueNotValidException('Given occupation id is not valid');
        }
        $this->_data['SenderOccupation'] = $occupationId;
        return $this;
    }

    /**
     * @param array $data
     * @return array
     */
    public function _validate(array $data) : array {
        $missing = array_diff(self::$requiredFields, array_keys($data));
        if (count($missing) > 0) {
            return [
                'message'   => 'Missing required values',
                'errors'    => array_values($missing)
            ];
        }
        return ['errors' => []];
    }

}
