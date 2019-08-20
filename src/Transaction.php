<?php
namespace TransPay;


use TransPay\Exceptions\ValueNotValidException;

class Transaction extends TransPayAbstract {
    /** @var array */
    public $_data = [
        'Sender'    => [],
        'Receiver'  => []
    ];

    /**
     * @param int $senderId
     * @return Transaction
     */
    public function setSenderId(int $senderId) : Transaction  {
        $this->_data['SenderId'] = $senderId;
        return $this;
    }

    /**
     * @param string $firstName
     * @return Transaction
     */
    public function setReceiverFirstName(string $firstName) : Transaction {
        $this->_data['Receiver']['FirstName'] = $firstName;
        return $this;
    }

    /**
     * @param string $lastName
     * @return Transaction
     */
    public function setReceiverLastName(string $lastName) : Transaction {
        $this->_data['Receiver']['LastName'] = $lastName;
        return $this;
    }

    /**
     * @param string $firstName
     * @return Transaction
     */
    public function setReceiverFirstNameOtherLanguage(string $firstName) : Transaction {
        $this->_data['Receiver']['FirstNameOtherLanguage'] = $firstName;
        return $this;
    }

    /**
     * @param string $name
     * @return Transaction
     */
    public function setReceiverSecondNameOtherLanguage(string $name) : Transaction {
        $this->_data['Receiver']['SecondNameOtherLanguage'] = $name;
        return $this;
    }

    /**
     * @param string $name
     * @return Transaction
     */
    public function setSecondName(string $name) : Transaction {
        $this->_data['Receiver']['SecondName'] = $name;
        return $this;
    }

    /**
     * @param string $name
     * @return Transaction
     */
    public function setLastNameOtherLanguage(string $name) : Transaction {
        $this->_data['Receiver']['LastNameOtherLanguage'] = $name;
        return $this;
    }

    /**
     * @param string $name
     * @return Transaction
     */
    public function setSecondLastName(string $name) : Transaction {
        $this->_data['Receiver']['SecondLastName'] = $name;
        return $this;
    }

    /**
     * @param string $name
     * @return Transaction
     */
    public function setSecondLastNameOtherLanguage(string $name) : Transaction {
        $this->_data['Receiver']['SecondLastNameOtherLanguage'] = $name;
        return $this;
    }

    /**
     * @param string $name
     * @return Transaction
     */
    public function setFullNameOtherLanguage(string $name) : Transaction {
        $this->_data['Receiver']['FullNameOtherLanguage'] = $name;
        return $this;
    }

    /**
     * @param string $address
     * @return Transaction
     */
    public function setCompleteAddress(string $address) : Transaction {
        $this->_data['Receiver']['CompleteAddress'] = $address;
        return $this;
    }

    /**
     * @param string $countryCode
     * @return Transaction
     */
    public function setCountryIsoCode(string $countryCode) : Transaction {
        $this->_data['Receiver']['CountryIsoCode'] = $countryCode;
        return $this;
    }

    /**
     * @param string $phone
     * @return Transaction
     */
    public function setMobilePhone(string $phone) : Transaction {
        $this->_data['Receiver']['MobilePhone'] = $phone;
        return $this;
    }

    /**
     * @param boolean $individual
     * @return Transaction
     */
    public function setIsIndividual(bool $individual) : Transaction {
        $this->_data['Receiver']['IsIndividual'] = $individual;
        return $this;
    }

    /**
     * @param string $email
     * @return $this
     */
    public function setEmail(string $email) : Transaction {
        $this->_data['Receiver']['Email'] = $email;
        return $this;
    }

    /**
     * @param string $typeOfId
     * @return Transaction
     */
    public function setReceiverTypeOfId(string $typeOfId) : Transaction {
        $this->_data['Receiver']['ReceiverTypeOfId'] = $typeOfId;
        return $this;
    }

    /**
     * @param string $receiverIdNumber
     * @return Transaction
     */
    public function setReceiverIdNumber(string $receiverIdNumber) : Transaction {
        $this->_data['Receiver']['ReceiverIdNumber'] = $receiverIdNumber;
        return $this;
    }

    /**
     * @param string $cpf
     * @return Transaction
     */
    public function setCpf(string $cpf) : Transaction {
        $this->_data['Receiver']['Cpf'] = $cpf;
        return $this;
    }

    /**
     * @param string $notes
     * @return Transaction
     */
    public function setNotes(string $notes) : Transaction {
        $this->_data['Receiver']['Notes'] = $notes;
        return $this;
    }

    /**
     * @param string $notes
     * @return Transaction
     */
    public function setNotesOtherLanguage(string $notes) : Transaction {
        $this->_data['Receiver']['NotesOtherLanguage']  = $notes;
        return $this;
    }

    /**
     * @param string $dateOfBirth
     * @return Transaction
     */
    public function setDateOfBirth(string $dateOfBirth) : Transaction {
        $this->_data['Receiver']['DateOfBirth'] = $dateOfBirth;
        return $this;
    }
}











