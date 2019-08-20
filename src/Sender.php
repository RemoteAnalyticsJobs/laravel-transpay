<?php
namespace TransPay;


use TransPay\Exceptions\InvalidAddressException;
use TransPay\Exceptions\ValueNotValidException;

class Sender extends TransPayAbstract {

    /** @var array */
    public $_data;

    public function create(array $data) {
        $response = $this->_httpClient->request('api/transaction/sender', $data);
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
        $this->_data['name'] = $fullName;
        return $this;
    }

    /**
     * It sets street address of the user
     * @param string $address
     * @return Sender
     * @throws ValueNotValidException
     */
    public function setStreetAddress(string $address) : Sender {
        if (!$address || !preg_match('/^[A-Za-z0-9\s]{5,60}$/', $address) || preg_match('/^PO BOX/', $address)) {
            throw new InvalidAddressException('Invalid street address provided. It should not be empty or PO BOX address');
        }
        $this->_data['address'] = $address;
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
        $this->_data['phone'] = $phone;
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
        $this->_data['idType'] = $idType;
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
        $this->_data['nameOtherLanguage'] = $name;
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
        $this->_data['addressOtherLanguage'] = $address;
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
        $this->_data['phoneHome'] = $phone;
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
        $this->_data['phoneWork'] = $phone;
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

        $this->_data['zipCode'] = $zipCode;
        return $this;
    }

    /**
     * @param int $cityId
     * @return Sender
     * @throws ValueNotValidException
     */
    public function setCityId(string $cityId) : Sender {
        if (!$cityId || !preg_match('/(?<=\s|^)\d+(?=\s|$)/', $cityId)) {
            throw new ValueNotValidException('Invalid city id');
        }
        $this->_data['cityId'] = $cityId;
        return $this;
    }

    /**
     * It will set state id
     * @param string $stateId
     * @return Sender
     * @throws ValueNotValidException
     */
    public function setStateId(string $stateId) : Sender {
        if (!$stateId || preg_match('/^[A-Za-z\s]{2,40}$/', $stateId)) {
            throw new ValueNotValidException('Invalid State id');
        }
        $this->_data['stateId'] = $stateId;
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
        $this->_data['countryIsoCode'] = $countryIsoCode;
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
        $this->_data['idNumber'] = $idNumber;
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
        $this->_data['idExpiryDate'] = $expiryDate;
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
        $this->_data['nationalityIsoCode'] = $nationalityIsoCode;
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
        $this->_data['dateOfBirth'] = $dob;
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
        $this->_data['email'] = $email;
        return $this;
    }

    /**
     * @param bool $isIndividual
     * @return Sender
     */
    public function setIsIndividual(bool $isIndividual) : Sender {
        $this->_data['isIndividual'] = $isIndividual;
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
        $this->_data['senderOccupation'] = $occupationId;
        return $this;
    }

}
