<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HomeOwner;

class UploadController extends Controller
{
    public function index()
    {
        return view('upload');
    }

    public function upload(Request $request)
    {
        //Process the uploaded CSV file
        $csvFile = $request->file('csv_file');
        $peopleArray = $this->processCSV($csvFile->getPathname());

        // Return the JSON response
        //return response()->json($peopleArray);
        return view('owners')->with('homeowners', $peopleArray);
    }

    public function splitName($name) {
        $nameParts = preg_split('/\s+(&|and)\s+/', $name);
        $people = array();
        $nextParts = array();
    
        $numParts = count($nameParts);
    
        for ($i = 0; $i < $numParts; $i++) {
            $name = trim($nameParts[$i]);
            $parts = explode(' ', $name, 3);
    
            //if last name is empty needs to get the last name of the following string
            if (empty($parts[2]) && $i + 1 < $numParts) {
                $nextParts = explode(' ', $nameParts[$i + 1], 3);
                $parts[3] = isset($nextParts[3]);
                $nameParts[$i] = implode(' ', $parts);
            }
            
            //Skip if any of the name parts are empty
            if (!empty($parts[0])) {
                $person = new HomeOwner(
                    $parts[0],
                    isset($parts[1]) && $parts[1] !== end($nextParts) && strlen($parts[1]) > 2 ? $parts[1] : "null",
                    isset($parts[1]) && strlen($parts[1]) <= 2 ? $parts[1] : "null",
                    $parts[2] ?? end($nextParts),
                );
                $people[] = $person;
            }
        }
        
        return $people;
    }
    

    //Function to process CSV and generate array of people
    private function processCSV($csvFile) {
        $people = array();
        
        if (($handle = fopen($csvFile, "r")) !== FALSE) {
            fgetcsv($handle, 1000, ",");
            while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                foreach ($data as $name) {
                    $people = array_merge($people, $this->splitName($name));
                }
            }
            fclose($handle);
        }
        
        return $people;
    }

}
