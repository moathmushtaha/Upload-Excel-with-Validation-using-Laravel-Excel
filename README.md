# Upload Excel with Validation using Laravel Excel

A **Laravel** application demonstrating how to handle Excel file uploads with row-level validation using the [Laravel Excel](https://laravel-excel.com/) package (Maatwebsite). This project validates imported data against custom rules and returns structured error reports per invalid row.

## 🚀 Features

- **Excel File Upload** — Accept `.xlsx` / `.csv` file uploads via a web form
- - **Row-level Validation** — Validate each row against Laravel validation rules
  - - **Error Reporting** — Return detailed validation errors per row
    - - **Import/Export** — Powered by Laravel Excel (Maatwebsite) for clean, readable import logic
      - - **Data Persistence** — Successfully validated rows are stored to the database
        - - **Real-world Use Case** — Track applications over the last 5 years
         
          - ## 🛠 Tech Stack
         
          - | Layer | Technology |
          - |---|---|
          - | Backend Framework | Laravel (PHP 8+) |
          - | Excel Handling | Laravel Excel (Maatwebsite/Excel) |
          - | Templating | Laravel Blade |
          - | Database | MySQL |
          - | Validation | Laravel Form Requests / Import Validation |
         
          - ## 📦 Languages
         
          - - PHP (primary)
            - - Blade templates
             
              - ## ⚙️ Setup & Installation
             
              - ```bash
                git clone https://github.com/moathmushtaha/Upload-Excel-with-Validation-using-Laravel-Excel.git
                cd Upload-Excel-with-Validation-using-Laravel-Excel
                composer install
                cp .env.example .env
                php artisan key:generate
                php artisan migrate
                php artisan serve
                ```

                ### Required Environment Variables

                ```env
                DB_CONNECTION=mysql
                DB_DATABASE=your_database
                DB_USERNAME=your_username
                DB_PASSWORD=your_password
                ```

                ## 📊 How It Works

                1. User uploads an Excel/CSV file through the web interface
                2. 2. The Laravel Excel importer reads each row
                   3. 3. Each row is validated against defined rules (e.g. required fields, data types, formats)
                      4. 4. Invalid rows are collected and returned as structured validation errors
                         5. 5. Valid rows are saved to the database
                            6. 6. The user receives a success/failure report
                              
                               7. ## 💡 Skills Demonstrated
                              
                               8. - **Laravel Excel integration** — import with row validation using `WithValidation` concern
                                  - - **Batch data processing** — handling large datasets row by row
                                    - - **Custom validation rules** — field-level error reporting per row
                                      - - **File upload handling** — secure multipart form uploads in Laravel
                                        - - **Database migrations & Eloquent ORM** — structured data persistence
                                          - - **MVC pattern** — clean separation of controllers, models, and views
                                           
                                            - ## 👤 Author
                                           
                                            - **Moath A. Mushtaha**
                                            - - GitHub: [@moathmushtaha](https://github.com/moathmushtaha)
                                             
                                              - ## 📄 License
                                             
                                              - MIT
