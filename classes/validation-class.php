<?php

/**
 * The Validation abstract class is a set of user input validation methods.
 *
 * User: Mole
 * Date: Feb/9/2017
 * Time: 4:12 PM
 */
abstract class Validation
{
    
    protected static $val_error;

     /**
     * This function allows only characters and space to be validated
     * ex. 'abc' or 'abc def' is valid.
     * @param: <String>
     * @return boolean
     */
    public static function validateFirstName($input_firstname)
    {
        $pattern = '/[^a-zA-Z\p{Greek}\s]++/u';
        if(preg_match($pattern, $input_firstname)){
            return false;
        }

        return true;
    }


    /**
     * This function allows only characters and space to be validated
     * ex. 'abc' or 'abc def' is valid.
     * @param: <String>
     * @return boolean
     */
    public static function validateLastName($input_lastname)
    {
        $pattern = '/[^a-zA-Z\p{Greek}\s]++/u';
        if(preg_match($pattern, $input_lastname)){
            return false;
        }

        return true;
    }

    /**
     * This function allows only digits and space to be validated
     * @param: <String>
     * @return boolean
     */
    public static function ValidateId($int)
    {
        $int = trim($int);
        if($int == ''){
            self::$val_error = "Το πεδίο είναι κενό";
            return false;
        }

        $pattern = '/[^0-9]++/u';
        if(preg_match($pattern, $int)){
            self::$val_error = "Please enter numbers only";
            return false;
        }

        return true;
    }


    /**
     * This function allows only text with valid characters  to be validated
     * Validating the email's or comment subject.
     * @param: <String>
     * @return boolean
     */
    public static function validateSubject($input_text)
    {
        $input_text =  trim($input_text);
        if($input_text == ""){
            self::$val_error = "Please enter a subject</span>";
            return false;
        }

        $pattern = '/[^a-zA-Z0-9\p{Greek}\s\,\.\?\;\:]++/u';
        if(preg_match($pattern, $input_text, $matches)){
            self::$val_error = "The character ( $matches[0] ) is not allowed in subject field</span>";
            return false;
        }

        return true;
    }
    
    
    /**
     * This function allows only text with valid characters  to be validated
     * Validating the email's or comment text message.
     * @param: <String>
     * @return boolean
     */
    public static function validateTextMessage($input_text)
    {
        $input_text =  trim($input_text);
        if($input_text == ""){
            self::$val_error = "Field is empty";
            return false;
        }
        
        $pattern = '/[^a-zA-Z0-9\p{Greek}\.\,\s\'\?\:\;\&\%\@\*\(\)\"\!]++/u';
        if(preg_match($pattern, $input_text, $matches)){
            self::$val_error = "The character ( $matches[0] ) is not allowed</span>";
            return false;
        }

        return true;
    }


    /**
     * This function allows only valid email characters to be validated
     * Validating the email address.
     * @param $email
     * @return bool
     */
    public static function validateEmail($email)
    {
        $email = trim($email);
        if(empty($email)){
            self::$val_error = "Please enter an email";
            return false;
        }

        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            self::$val_error = "Please enter a valid email";
            return false;
        }
        return true;
    }


    /**
     * This function checks the database if email exists
     * @param $table <String>
     * @param $column <String>
     * @param $email
     * @return bool true if email exists.
     */
    public static function checkDatabaseForEmail($table, $column, $email)
    {
        $email = trim($email);
        $sql = "SELECT $column FROM $table WHERE $column = ?";
        Db::query($sql, array($email));
        if (Db::$affected_rows == 0) {
            return false;
        } else {
            return true;
        }
    }
    
    /**
     * Validating the users password input.
     * Only characters and digits are allowed.
     * @param $password
     * @return  bool
     */
    public static function validatePassword($password)
    {
        $password = trim($password);
        
        if(empty($password)){
            self::$val_error = "Το πεδίο ειναι κενό";
            return false;
        }

        /* No spaces accepted */
        $pattern = '/[\s]/';
        if(preg_match($pattern, $password)){
            self::$val_error = "Ο κωδικός δεν μπορεί να έχει κενό";
            return false;
        }
      
        if(mb_strlen($password, 'UTF-8') > 10){
            self::$val_error = "Ο κωδικός πρέπει να είναι μέχρι και 10 χαρακτήρες";
            return false;
        }
        
        $pattern = '/[^a-zA-Z0-9\p{Greek}\s]++/u';
        if(preg_match($pattern, $password)){
            self::$val_error = "Μόνο χαρακτήρες και ψηφία επιτρέπονται";
            return false;
        }

        return true;
    }


    /**
     * This function checks the database if password exists
     * @param $table <String>
     * @param $column <String>
     * @param $password
     * @return bool true if password exists.
     */
    public static function checkDatabaseForPassword($table, $column, $password)
    {
        $password = trim($password);
        $password = md5($password);
        $sql = "SELECT $column FROM $table WHERE $column = ?";
        Db::query($sql, array($password));
        if (Db::$affected_rows == 0) {
            return false;
        } else {
            return true;
        }
    }


    /**
     * Validating the users username input.
     * Only characters and digits are allowed.
     * @param $username
     * @return bool
     */
    public static function validateUsername($username)
    {
        $username = trim($username);

        if(empty($username)){
            self::$val_error = "Please enter a username";
            return false;
        }

        /* no longer than 10 characters */
        if(mb_strlen($username, 'UTF-8') > 10){
            self::$val_error = "Username must be not longer than 10 characters</span>";
            return false;
        }

        /* No spaces accepted */
        $pattern = '/[\s]/';
        if(preg_match($pattern, $username)){
            self::$val_error = "no spaces are allowed in username field";
            return false;
        }

        $pattern = '/[^a-zA-Z0-9\p{Greek}]++/u';
        if(preg_match($pattern, $username)){
            self::$val_error = "Only characters and digits are allowed";
            return false;
        }

        return true;
    }


    /**
     * This function checks the database if username exists
     * @param $table <String>
     * @param $column <String>
     * @param $username
     * @return bool true if username exists.
     */
    public static function checkDatabaseForUsername($table, $column, $username)
    {
        $username = trim($username);
        $sql = "SELECT $column FROM $table WHERE $column = ?";
        Db::query($sql, array($username));
        if (Db::$affected_rows == 0) {
            return false;
        } else {
            return true;
        }
    }

    /**
     * Validating string input as text Allowed characters(. , ' space).
     * @param $string
     * @return bool
     */
    public static function validateAsText($string)
    {
        $string = trim($string);
        if(empty($string)){
            self::$val_error = "Το πεδίο είναι κενό";
            return false;
        }

        $pattern = '/[^a-zA-Z0-9\p{Greek}\_\-\=\.\,\s\'\?\:\;\&\%\@\*\"\!]++/u';
        if(preg_match($pattern, $string, $match)){
            self::$val_error = "Ειδικοί χαρακτήρες ( $match[0] ) δεν επιτρέπονται";
            return false;
        }

        return true;
    }


    /**
     * This function checks the database if a string of text exists
     * @param $table <String>
     * @param $column <String>
     * @param $text
     * @return bool true if text exists.
     * @internal param $email
     */
    public static function checkDatabaseForText($table, $column, $text)
    {
        $text = trim($text);
        $sql = "SELECT $column FROM $table WHERE $column = ?";
        Db::query($sql, array($text));
        if (Db::$affected_rows == 0) {
            return false;
        } else {
            return true;
        }
    }


    /**
     * Validating the name for invalid characters and size
     * @param $name
     * @return bool
     */
    public static function validateImageName($name)
    {
       if($name == ''){
           self::$val_error = "Επέλεξε μια εικόνα";
           return false;
       }

        $pattern = '/[^a-zA-Z0-9\p{Greek}\.\_\-\(\)\s]++/u';
        if(preg_match($pattern, $name ,$match)){
            self::$val_error = "Όνομα αρχείου: Μη επιτρεπόμενοι χαρακτήρες [ $match[0] ]";
            return false;
        }

        if(strlen($name) > 250){
            self::$val_error = "Το όνομα του αρχείου είναι πολύ μεγάλο";
            return false;
        }

        return true;
    }


    /**
     * validating the image type
     * @param $type
     * @return bool
     * @internal param $valid_extensions
     */
    public static function validateImageType($type)
    {
        $valid_extensions = array('image/jpeg','image/gif','image/png','image/jpeg', 'image/bmp');
        if(!in_array($type, $valid_extensions)){
            self::$val_error = ".jpg .png .gif .bmp αρχεία επιτρέπονται";
            return false;
        }

        return true;
    }


    /**
     * separating and returning the file extension.
     * @param $file
     * @return string
     */
    public static function getImageExtension($file)
    {
       return $ext = pathinfo($file, PATHINFO_EXTENSION);
    }


    /**
     * checking the image file size against the given size $int
     * @param $size
     * @param $int
     * @return bool
     */
    public static function validateImageSize($size)
    {
        if( $size > IMAGE_UPLOAD_MAX_SIZE ){
            self::$val_error = "Το αρχείο είναι μεγαλύτερο από ".IMAGE_UPLOAD_MAX_SIZE_IN_MB. "</span>";
            return false;
        }

        return true;
    }


    /**
     * Checking the database of an existing record
     * returns true if record exists
     * @param $table
     * @param $column
     * @param $image
     * @return bool
     */
    public static function checkDatabaseForImage($table, $column, $image)
    {
        $sql = "SELECT $column FROM $table WHERE $column = ?";
        Db::query($sql, array($image));
        if (Db::$affected_rows == 0) {
            return false;
        } else {
            return true;
        }
    }


    /**
     * @return mixed
     */    
    public static function getError()
    {
        return self::$val_error;
    }
    
}

























