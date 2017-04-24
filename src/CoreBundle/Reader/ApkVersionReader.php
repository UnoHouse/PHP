<?php

/**
 * Created by PhpStorm.
 * User: rafal
 * Date: 24.04.17
 * Time: 17:23
 */
namespace CoreBundle\Reader;
class ApkVersionReader
{

    public function getVersionCodeFromAPK($APKLocation)
    {

        $versionCode = "N/A";

        //AXML LEW 32-bit word (hex) for a start tag
        $XMLStartTag = "00100102";

        //APK is esentially a zip file, so open it
        $zip = zip_open($APKLocation);
        if ($zip) {
            while ($zip_entry = zip_read($zip)) {
                //Look for the AndroidManifest.xml file in the APK root directory
                if (zip_entry_name($zip_entry) == "AndroidManifest.xml") {
                    //Get the contents of the file in hex format
                    $axml = $this->getHex($zip, $zip_entry);
                    //Convert AXML hex file into an array of 32-bit words
                    $axmlArr = $this->convert2wordArray($axml);
                    //Convert AXML 32-bit word array into Little Endian format 32-bit word array
                    $axmlArr = $this->convert2LEWwordArray($axmlArr);
                    //Get first AXML open tag word index
                    $firstStartTagword = $this->findWord($axmlArr, $XMLStartTag);
                    //The version code is 13 words after the first open tag word
                    $versionCode = intval($axmlArr[$firstStartTagword + 13], 16);

                    break;
                }
            }
        }
        zip_close($zip);

        return $versionCode;
    }

    private function getHex($zip, $zip_entry)
    {
        if (zip_entry_open($zip, $zip_entry, 'r')) {
            $buf = zip_entry_read($zip_entry, zip_entry_filesize($zip_entry));
            $hex = unpack("H*", $buf);
            return current($hex);
        }
    }

    private function convert2wordArray($hex)
    {
        $wordArr = array();
        $numwords = strlen($hex) / 8;

        for ($i = 0; $i < $numwords; $i++)
            $wordArr[] = substr($hex, $i * 8, 8);

        return $wordArr;
    }

    private function convert2LEWwordArray($wordArr)
    {
        $LEWArr = array();

        foreach ($wordArr as $word) {
            $LEWword = "";
            for ($i = 0; $i < strlen($word) / 2; $i++)
                $LEWword .= substr($word, (strlen($word) - ($i * 2) - 2), 2);
            $LEWArr[] = $LEWword;
        }

        return $LEWArr;
    }

    private function findWord($wordArr, $wordToFind)
    {
        $currentword = 0;
        foreach ($wordArr as $word) {
            if ($word == $wordToFind)
                return $currentword;
            else
                $currentword++;
        }
    }
}