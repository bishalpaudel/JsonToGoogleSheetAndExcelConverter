# JsonToGoogleSheetAndExcelConverter
A simple converter to convert json input into Excel sheet and Google spreadsheet. Used Google Spreadsheet API to convert into Google spreadsheet.


### Project Structure:
- Controller: App\Http\Controllers\JsonConverterController [Folder: app/Http/Controllers]
- Routes:
    - API (for AJAX post and Delete comments): api.php [Folder: routes]
- Settings: .env
    - GOOGLE_SERVICE_ACCOUNT_JSON_LOCATION= (full path for google service account json file)
    - GOOGLE_APPLICATION_NAME= (Name of Google application)
    - GOOGLE_CLIENT_ID= (Google API OAuth2 client ID)
    - GOOGLE_CLIENT_SECRET= (Google API OAuth2 Client Secret)
    - GOOGLE_SERVICE_ENABLED= (true to enable)
    - GOOGLE_DEVELOPER_KEY= (Google Developer key)
    - GOOGLE_SHEET_ID= (identifier for spreadsheet to use)
- output:
    - CSV file location: storage/exports/PersonRecord.csv

## Requirements:
    - PHP7
    - Laravel5.4 and its dependencies
    - Postman for API simulation
    
## Installation:
    - Clone this repository and run into bash: 
        php composer.phar update
    - Set correct settings (based on your environment) on .env file
    - Add proper settings to .env file
    - Add google sheet scope into config/google.php into 'scopes' => [""]:
        - Example: 'scopes' => ["https://www.googleapis.com/auth/spreadsheets"]
    - Run PHP7 Server:
        php artisan serve
        Then use provided url to access the application in the browser.

## Usage:
###### To convert from JSON to Google Spreadsheet
        POST /api/convert/from/json/to/google-sheets HTTP/1.1
        Host: 127.0.0.1:8000
        Content-Type: application/json
        Cache-Control: no-cache
        
        {
        "student1":["view_grades","view_classes"],
        "student2":["view_grades","view_classes"],
        "teacher":["view_grades","change_grades","add_grades","delete_grades","view_classes"],
        "principle":["view_grades","view_classes","change_classes","add_classes","delete_classes"]
        }	
        
###### To convert from JSON to CSV file
        POST /api/convert/from/json/to/csv HTTP/1.1
        Host: 127.0.0.1:8000
        Content-Type: application/json
        Cache-Control: no-cache
        
        {
        "student1":["view_grades","view_classes"],
        "student2":["view_grades","view_classes"],
        "teacher":["view_grades","change_grades","add_grades","delete_grades","view_classes"],
        "principle":["view_grades","view_classes","change_classes","add_classes","delete_classes"]
        }	
        
## License

The TMBC comment application is open-sourced software licensed under the [MIT license](https://github.com/bishalpaudel/JsonToGoogleSheetAndExcelConverter/blob/master/LICENSE).
        