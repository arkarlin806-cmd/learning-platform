@extends('layout.ai')

@section('content')

<div class="app-shell w-full flex-1">

    <!-- Header -->
    <header class="top-fade header-glass">
        <div class="max-w-6xl mx-auto px-3 md:px-2 h-16 flex items-center justify-between">
            <div class="flex items-center gap-3 min-w-0">
                <button id="openSidebar"
                    class="lg:hidden w-11 h-11 rounded-2xl bg-white border border-slate-200 shadow-sm flex items-center justify-center text-slate-700 hover:scale-105 transition">
                    ☰
                </button>
                <div class="w-10 h-10 rounded-2xl bg-gradient-to-br from-blue-500 to-indigo-600 text-white flex items-center justify-center font-bold shadow-md shrink-0">
                    DB
                </div>
                <div class="min-w-0">
                    <h1 class="text-slate-900 font-semibold text-base md:text-lg truncate">
                        Database
                    </h1>
                    <p class="text-xs md:text-sm text-slate-500 truncate">
                        Learn anything, get clean answers instantly
                    </p>
                </div>
            </div>

            <div class="hidden sm:flex items-center gap-2">
                <span class="status-pill text-xs px-3 py-1.5 rounded-full">
                    Smart DB
                </span>
            </div>
        </div>
    </header>

    <div class="flex justify-between gap-2">

        <!-- left site -->
        <div id="content" class="overflow-y-auto h-screen space-y-16 ml-14 pr-8 pt-4 pb-40 w-full">

            @php

            $phases = [

            [
            'title' => 'Phase 1 : Database Fundamentals',
            'id' => 'intro',
            'parts' => [

            [
            'title' => 'Introduction',

            'items' => [
            [
            'title' => 'What is a Database?',
            'lists' => [
            'A database is an organized collection of related data.',
            'It stores data electronically.',
            'It allows users to access, manage and update data.'
            ],
            'example' => 'The Students table stores student information.'
            ],

            [
            'title' => 'Why is Database Important?',
            'lists' => [
            'Organizes large amounts of data.',
            'Provides fast searching.',
            'Improves security.',
            'Reduces duplicate data.'
            ],
            'example' => 'A university stores thousands of student records.'
            ],
            ]
            ],

            [
            'title' => 'Database vs File System',

            'items' => [

            [
            'title' => 'Database',

            'lists' => [
            'Stores data in structured tables.',
            'Supports relationships.',
            'Provides backup.'
            ],

            'example' => 'Student information is stored in Students table.'
            ],

            [
            'title' => 'File System',

            'lists' => [
            'Stores data in files.',
            'Hard to manage.',
            'Duplicate data may occur.'
            ],

            'example' => 'Each student is stored in a separate text file.'
            ],

            ]
            ],

            ]
            ],

            [
            'title' => 'Phase 2 : Database Concepts',
            'id' => 'concepts',

            'parts' => [

            [
            'title' => 'Database Concepts',

            'items' => [

            [
            'title' => 'Data',
            'lists' => [
            'Raw facts without processing.',
            'The basic element stored in a database.',
            'Used to create information.',
            ],
            'example' => "In the Students table:\n101\nAlice\n20",
            ],

            [
            'title' => 'Information',
            'lists' => [
            'Processed and meaningful data.',
            'Helps users understand data.',
            'Used for decision-making.',
            ],
            'example' => "From the Students table:\nAlice is a 20-year-old Computer Science student with a GPA of 3.80.",
            ],

            [
            'title' => 'Database',
            'lists' => [
            'Collection of related tables.',
            'Stores and manages data.',
            'Allows easy data retrieval.',
            ],
            'example' => "A university database contains:\nStudents table\nCourses table\nTeachers table",
            ],

            [
            'title' => 'DBMS (Database Management System)',
            'lists' => [
            'Software used to create and manage databases.',
            'Controls data storage and access.',
            'Provides security and backup features.',
            ],
            'example' => "MySQL manages the Students database and allows users to add, update, or delete student records.",
            ],

            [
            'title' => 'RDBMS (Relational Database Management System)',
            'lists' => [
            'Stores data in related tables.',
            'Uses Primary Key and Foreign Key.',
            'Uses SQL to manage data.',
            ],
            'example' => "Students table:\nStudentID | Name\n101 | Alice\n\nThe StudentID can connect with other tables like Enrollment.",
            ],

            ],
            ],

            ],
            ],
            [
            'title' => 'Phase 3 : Database Components',
            'id' => 'components',

            'parts' => [

            [
            'title' => 'Database Components',

            'items' => [

            [
            'title' => 'Table',
            'lists' => [
            'Stores data in rows and columns.',
            'Represents an entity.',
            ],
            'example' => 'Students is a table that stores student records.',
            ],

            [
            'title' => 'Row (Record)',
            'lists' => [
            'Represents one complete data entry.',
            'Contains information about one item.',
            ],
            'example' => '101 | Alice | 20 | Computer Science | 3.80',
            ],

            [
            'title' => 'Column (Field)',
            'lists' => [
            'Represents a specific attribute.',
            'Defines the type of data stored.',
            ],
            'example' => 'Name column stores student names.',
            ],

            [
            'title' => 'Primary Key',
            'lists' => [
            'Uniquely identifies each record.',
            'Cannot contain duplicate values.',
            'Cannot be NULL.',
            ],
            'example' => 'StudentID is the Primary Key.',
            ],

            [
            'title' => 'Foreign Key',
            'lists' => [
            'Connects two tables.',
            'References a Primary Key from another table.',
            ],
            'example' => 'Enrollment table uses StudentID to connect with Students table.',
            ],

            ],

            ],

            ],

            ],

            [
            'title' => 'Phase 4 : Data Types',
            'id' => 'types',

            'parts' => [

            [
            'title' => 'Data Types',

            'items' => [

            [
            'title' => 'What are Data Types?',
            'lists' => [
            'Data types define what kind of data can be stored in a column.',
            'They help the database store data correctly.',
            'They improve data accuracy.',
            ],
            'example' => "Students table:\n\nColumn Data Type\n--------------------------\nStudentID Integer\nName VARCHAR\nAge Integer\nGPA Decimal",
            ],

            ],

            ],

            [
            'title' => 'Common Data Types',

            'items' => [

            [
            'title' => 'Integer',
            'lists' => [
            'Stores whole numbers.',
            'Does not store decimal values.',
            ],
            'example' => 'Age = 20',
            ],

            [
            'title' => 'VARCHAR',
            'lists' => [
            'Stores text or characters.',
            'Used for names and descriptions.',
            ],
            'example' => 'Name = Alice',
            ],

            [
            'title' => 'Decimal',
            'lists' => [
            'Stores numbers with decimal points.',
            'Used for accurate calculations.',
            ],
            'example' => 'GPA = 3.80',
            ],

            [
            'title' => 'Date',
            'lists' => [
            'Stores date values.',
            'Used for events and records.',
            ],
            'example' => 'EnrollmentDate = 2026-07-18',
            ],

            ],

            ],

            ],

            ],
            [
            'title' => 'Phase 5 : SQL Basics',
            'id' => 'basics',

            'parts' => [

            [
            'title' => 'SQL Basics',

            'items' => [

            [
            'title' => 'What is SQL?',
            'lists' => [
            'SQL (Structured Query Language) is used to communicate with databases.',
            'It allows users to create, read, update, and delete data.',
            ],
            'example' => 'SELECT * FROM Students;',
            ],

            [
            'title' => 'INSERT',
            'lists' => [
            'Adds new records into a table.',
            ],
            'example' => "INSERT INTO Students VALUES (105,'Emma',20,'Computer Science',3.70);",
            ],

            [
            'title' => 'SELECT',
            'lists' => [
            'Retrieves data from a table.',
            'Used to search information.',
            ],
            'example' => 'SELECT Name, GPA FROM Students;',
            ],

            [
            'title' => 'UPDATE',
            'lists' => [
            'Modifies existing data.',
            ],
            'example' => "UPDATE Students
            SET GPA = 3.95
            WHERE StudentID = 101;",
            ],

            [
            'title' => 'DELETE',
            'lists' => [
            'Removes data from a table.',
            ],
            'example' => "DELETE FROM Students
            WHERE StudentID = 104;",
            ],

            ],

            ],

            ],

            ],
            [
            'title' => 'Phase 6 : SQL Clauses',
            'id' => 'clauses',

            'parts' => [

            [
            'title' => 'SQL Clauses',

            'items' => [

            [
            'title' => 'WHERE',
            'lists' => [
            'Filters data based on conditions.',
            'Returns only matching records.',
            ],
            'example' => "SELECT * FROM Students
            WHERE Department = 'Computer Science';",
            ],

            [
            'title' => 'ORDER BY',
            'lists' => [
            'Sorts data in ascending or descending order.',
            ],
            'example' => "SELECT * FROM Students
            ORDER BY GPA DESC;",
            ],

            [
            'title' => 'GROUP BY',
            'lists' => [
            'Groups rows with similar values.',
            'Used with aggregate functions.',
            ],
            'example' => "SELECT Department, COUNT(*)
            FROM Students
            GROUP BY Department;",
            ],

            [
            'title' => 'HAVING',
            'lists' => [
            'Filters grouped data.',
            'Used with GROUP BY.',
            ],
            'example' => "SELECT Department, COUNT(*)
            FROM Students
            GROUP BY Department
            HAVING COUNT(*) > 2;",
            ],

            [
            'title' => 'LIMIT',
            'lists' => [
            'Controls the number of returned records.',
            ],
            'example' => "SELECT * FROM Students
            LIMIT 3;",
            ],

            ],

            ],

            ],

            ],
            [
            'title' => 'Phase 7 : Database Relationships',
            'id' => 'relationships',

            'parts' => [

            [
            'title' => 'Database Relationships',

            'items' => [

            [
            'title' => 'One-to-One Relationship',
            'lists' => [
            'One record connects to only one record.',
            'Used when data is separated for security or organization.',
            ],
            'example' => 'One student → One student profile.',
            ],

            [
            'title' => 'One-to-Many Relationship',
            'lists' => [
            'One record connects to many records.',
            'The most common relationship.',
            ],
            'example' => 'One department → Many students.',
            ],

            [
            'title' => 'Many-to-Many Relationship',
            'lists' => [
            'Many records connect to many records.',
            'Requires a middle table.',
            ],
            'example' => "One student can take many courses.\nOne course can have many students.",
            ],

            ],

            ],

            ],

            ],
            [
            'title' => 'Phase 8 : Normalization',
            'id' => 'normalization',

            'parts' => [

            [
            'title' => 'Normalization',

            'items' => [

            [
            'title' => 'What is Normalization?',
            'lists' => [
            'Organizes data to reduce duplication.',
            'Improves data consistency.',
            'Divides large tables into smaller related tables.',
            ],
            'example' => "Instead of storing:

            StudentID | StudentName | Course1 | Course2

            Separate into:

            Students Table
            Courses Table
            Enrollment Table",
            ],

            [
            'title' => '1NF (First Normal Form)',
            'lists' => [
            'Each column contains atomic values.',
            'No multiple values in one column.',
            ],
            'example' => "Wrong:

            Student | Courses
            Alice | Database, Programming

            Correct:

            Separate course records.",
            ],

            [
            'title' => '2NF (Second Normal Form)',
            'lists' => [
            'Must satisfy 1NF.',
            'Removes partial dependency.',
            ],
            'example' => 'Student information should not repeat in the Enrollment table.',
            ],

            [
            'title' => '3NF (Third Normal Form)',
            'lists' => [
            'Must satisfy 2NF.',
            'Removes unnecessary dependencies.',
            ],
            'example' => 'Department details should be stored separately.',
            ],

            ],

            ],

            ],

            ],
            [
            'title' => 'Phase 9 : Joins',
            'id' => 'joins',

            'parts' => [

            [
            'title' => 'Joins',

            'items' => [

            [
            'title' => 'What is Join?',
            'lists' => [
            'Join combines data from multiple tables.',
            'It uses related columns between tables.',
            'It is used to retrieve meaningful information.',
            ],
            'example' => "Students Table:

            StudentID | Name
            101 | Alice
            102 | Bob


            Enrollment Table:

            StudentID | Course
            101 | Database
            102 | Programming",
            ],


            [
            'title' => 'INNER JOIN',
            'lists' => [
            'Returns only matching records from both tables.',
            'Used when both tables have related data.',
            ],
            'example' => "SELECT Students.Name, Enrollment.Course
            FROM Students
            INNER JOIN Enrollment
            ON Students.StudentID = Enrollment.StudentID;",
            ],


            [
            'title' => 'LEFT JOIN',
            'lists' => [
            'Returns all records from the left table.',
            'Shows matching records from the right table.',
            'Returns NULL when no matching record exists.',
            ],
            'example' => "SELECT Students.Name, Enrollment.Course
            FROM Students
            LEFT JOIN Enrollment
            ON Students.StudentID = Enrollment.StudentID;


            Result:

            All students are displayed even if they have no course.",
            ],


            [
            'title' => 'RIGHT JOIN',
            'lists' => [
            'Returns all records from the right table.',
            'Shows matching records from the left table.',
            'Returns NULL when no matching record exists.',
            ],
            'example' => "SELECT Students.Name, Enrollment.Course
            FROM Students
            RIGHT JOIN Enrollment
            ON Students.StudentID = Enrollment.StudentID;


            Result:

            All courses are displayed even if no student is assigned.",
            ],


            [
            'title' => 'FULL OUTER JOIN',
            'lists' => [
            'Returns all records from both tables.',
            'Shows matching and non-matching records.',
            'Combines LEFT JOIN and RIGHT JOIN behavior.',
            ],
            'example' => "SELECT Students.Name, Enrollment.Course
            FROM Students
            FULL OUTER JOIN Enrollment
            ON Students.StudentID = Enrollment.StudentID;


            Result:

            Shows all students and all courses.",
            ],


            ],

            ],

            ],

            ],
            [
            'title' => 'Phase 10 : Constraints',
            'id' => 'constraints',

            'parts' => [

            [
            'title' => 'Constraints',

            'items' => [

            [
            'title' => 'What are Constraints?',
            'lists' => [
            'Constraints are rules applied to columns.',
            'They maintain data accuracy and integrity.',
            'They prevent invalid data from being stored.',
            ],
            'example' => "Example:

            Student Table

            StudentID | Name
            101 | Alice
            102 | Bob

            StudentID follows constraint rules.",
            ],


            [
            'title' => 'PRIMARY KEY',
            'lists' => [
            'Uniquely identifies each record.',
            'Cannot have duplicate values.',
            'Cannot contain NULL values.',
            ],
            'example' => "Example:

            CREATE TABLE Students (
            StudentID INT PRIMARY KEY,
            Name VARCHAR(100)
            );


            StudentID is the Primary Key.",
            ],


            [
            'title' => 'FOREIGN KEY',
            'lists' => [
            'Creates relationships between tables.',
            'References another table’s Primary Key.',
            'Maintains referential integrity.',
            ],
            'example' => "Example:

            Students Table:

            StudentID (Primary Key)


            Enrollment Table:

            StudentID (Foreign Key)


            Enrollment table uses StudentID from Students table.",
            ],


            [
            'title' => 'UNIQUE',
            'lists' => [
            'Prevents duplicate values in a column.',
            'Each value must be different.',
            'Used for data like email addresses.',
            ],
            'example' => "Example:

            CREATE TABLE Users (
            Email VARCHAR(100) UNIQUE
            );


            Each student email must be different.",
            ],


            ],

            ],

            ],

            ],
            ];

            @endphp
            @foreach($phases as $phase)

            <section class="py-10 px-10 bg-white/80 rounded-4xl shadow-xl" id="{{ $phase['id'] }}">

                <h1 class="text-3xl font-bold mb-6 text-blue-700">
                    {{ $phase['title'] }}
                </h1>

                @foreach($phase['parts'] as $part)

                <h2 class="text-2xl font-semibold mb-5">
                    {{ $part['title'] }}
                </h2>

                @foreach($part['items'] as $item)

                <div class="bg-white rounded-2xl shadow p-6 mb-6">

                    <h3 class="text-xl font-bold mb-4">
                        {{ $item['title'] }}
                    </h3>

                    <ul class="space-y-2 mb-5">
                        @foreach($item['lists'] as $list)
                        <li><span class="text-blue-700 px-2 font-bold">✓</span> {{ $list }}</li>
                        @endforeach
                    </ul>

                    <div class="bg-gray-900 text-white rounded-xl p-5 relative">

                        <button
                            class="absolute right-3 top-3 bg-blue-500 px-3 py-1 rounded text-xs">
                            Copy
                        </button>

                        <p class="text-gray-400 mb-2">SQL Example</p>

                        <pre>{{ $item['example'] }}</pre>

                    </div>

                </div>

                @endforeach

                @endforeach
            </section>

            @endforeach

            <!-- Advanced Database Learning Websites -->
            <section id="refrences" class="py-6 px-10 bg-white/80 rounded-4xl shadow-xl0">
                <!-- Best Database Learning Websites -->



                <h3 class="text-3xl font-bold text-blue-700 my-8">Best Database Learning Websites</h3>
                <div class="resource">
                    <div class="text-slate-600 font-bold my-3 flex">
                        SQLBolt - <a href="https://www.sqlbolt.com/" target="_blank" class="text-blue-700 hover:underline">
                            Interactive SQL Lessons
                        </a>
                    </div>
                    <div class="text-slate-600 font-bold my-3 flex">
                        PostgreSQL Official Documentation - <a href="https://www.postgresql.org/docs/" target="_blank" class="text-blue-700 hover:underline">
                            Advanced Database
                        </a>
                    </div>

                    <div class="text-slate-600 font-bold my-3 flex">
                        MySQL Official Documentation - <a href="https://dev.mysql.com/doc/" target="_blank" class="text-blue-700 hover:underline">
                            Database Development
                        </a>
                    </div>

                    <div class="text-slate-600 font-bold my-3 flex">
                        MongoDB University -<a href="https://www.mongodb.com/learn" target="_blank" class="text-blue-700 hover:underline">
                            NoSQL Database Learning
                        </a>
                    </div>

                    <div class="text-slate-600 font-bold my-3 flex">
                        Oracle Database - <a href="https://www.oracle.com/database/learn/" target="_blank" class="text-blue-700 hover:underline">
                            Oracle Database Learning Center
                        </a>
                    </div>

                </div>

                <hr class="text-slate-600 dot-line my-3">
                <!-- Best Database Learning Apps -->

                <div class="resource">

                    <h3 class="text-3xl font-bold text-purple-700 mt-3 mb-8">Best Database Learning Apps</h3>

                    <div class="text-slate-600 font-bold my-3 flex">
                        DataCamp - <a href="https://www.datacamp.com/" target="_blank" class="text-blue-700 hover:underline">
                            SQL & Database Practice App
                        </a>
                    </div>

                    <div class="text-slate-600 font-bold my-3 flex">
                        SoloLearn - <a href="https://www.sololearn.com/" target="_blank" class="text-blue-700 hover:underline">
                            SQL Database Learning App
                        </a>
                    </div>

                </div>
            </section>
            <section id="sample-db" class="px-8 py-4 bg-white/80 rounded-4xl shadow-xl">

                <h1 class="my-4 text-slate-700 text-3xl font-semibold">Run Box</h1>
                <textarea
                    id="query"
                    class="w-full h-20 px-4 rounded-2xl bg-orange-200 pt-6">
SELECT * FROM users;
                            </textarea>

                <button
                    onclick="runQuery()"
                    class="mt-4 bg-blue-700 text-white px-6 py-3 rounded-xl">
                    RUN QUERY
                </button>

                <div id="output"
                    class="mt-8"></div>

            </section>
        </div>


        <!-- right site  -->
        <div class="w-70 h-screen  bg-gradient-to-br from-indigo-200 via-white to-purple-300
            py-2 pl-5 hidden md:flex">

            <ul class="space-y-2">

                <li class="group flex items-center gap-4 px-4 py-2 rounded-xl bg-gradient-to-r from-white to-blue-100 shadow hover:shadow-lg transition">
                    <div class="w-2 h-8 bg-blue-500 rounded-full"></div>
                    <div>
                        <h3 class="font-bold text-gray-800 group-hover:text-blue-600">
                            <a href="#" onclick="goToSection('intro')">
                                Introduction
                            </a>
                        </h3>
                    </div>
                </li>
                <li class="group flex items-center gap-4 px-4 py-2 rounded-xl bg-gradient-to-r from-white to-blue-100 shadow hover:shadow-lg transition">
                    <div class="w-2 h-8 bg-blue-500 rounded-full"></div>
                    <div>
                        <h3 class="font-bold text-gray-800 group-hover:text-blue-600">
                            <a href="#" onclick="goToSection('concepts')">
                                Concepts
                            </a>
                        </h3>
                    </div>
                </li>
                <li class="group flex items-center gap-4 px-4 py-2 rounded-xl bg-gradient-to-r from-white to-blue-100 shadow hover:shadow-lg transition">
                    <div class="w-2 h-8 bg-blue-500 rounded-full"></div>
                    <div>
                        <h3 class="font-bold text-gray-800 group-hover:text-blue-600">
                            <a href="#" onclick="goToSection('components')">
                                Components
                            </a>
                        </h3>
                    </div>
                </li>
                <li class="group flex items-center gap-4 px-4 py-2 rounded-xl bg-gradient-to-r from-white to-blue-100 shadow hover:shadow-lg transition">
                    <div class="w-2 h-8 bg-green-500 rounded-full"></div>
                    <div>
                        <h3 class="font-bold text-gray-800 group-hover:text-green-600">
                            <a href="#" onclick="goToSection('types')">
                                Type
                            </a>
                        </h3>
                    </div>
                </li>
                <li class="group flex items-center gap-4 px-4 py-2 rounded-xl bg-gradient-to-r from-white to-blue-100 shadow hover:shadow-lg transition">
                    <div class="w-2 h-8 bg-purple-500 rounded-full"></div>
                    <div>
                        <h3 class="font-bold text-gray-800 group-hover:text-purple-600">
                            <a href="#" onclick="goToSection('basics')">
                                Basics
                            </a>
                        </h3>
                    </div>
                </li>
                <li class="group flex items-center gap-4 px-4 py-2 rounded-xl bg-gradient-to-r from-white to-blue-100 shadow hover:shadow-lg transition">
                    <div class="w-2 h-8 bg-orange-500 rounded-full"></div>
                    <div>
                        <h3 class="font-bold text-gray-800 group-hover:text-orange-600">
                            <a href="#" onclick="goToSection('clauses')">
                                Clauses
                            </a>
                        </h3>
                    </div>
                </li>
                <li class="group flex items-center gap-4 px-4 py-2 rounded-xl bg-gradient-to-r from-white to-blue-100 shadow hover:shadow-lg transition">
                    <div class="w-2 h-8 bg-yellow-500 rounded-full"></div>
                    <div>
                        <h3 class="font-bold text-gray-800 group-hover:text-yellow-600">
                            <a href="#" onclick="goToSection('relationships')">
                                Relationships
                            </a>
                        </h3>
                    </div>
                </li>
                <li class="group flex items-center gap-4 px-4 py-2 rounded-xl bg-gradient-to-r from-white to-blue-100 shadow hover:shadow-lg transition">
                    <div class="w-2 h-8 bg-cyan-500 rounded-full"></div>
                    <div>
                        <h3 class="font-bold text-gray-800 group-hover:text-cyan-600">
                            <a href="#" onclick="goToSection('normalization')">
                                Normalization
                            </a>
                        </h3>
                    </div>
                </li>
                <li class="group flex items-center gap-4 px-4 py-2 rounded-xl bg-gradient-to-r from-white to-blue-100 shadow hover:shadow-lg transition">
                    <div class="w-2 h-8 bg-pink-500 rounded-full"></div>
                    <div>
                        <h3 class="font-bold text-gray-800 group-hover:text-pink-600">
                            <a href="#" onclick="goToSection('joins')">
                                Joins
                            </a>
                        </h3>
                    </div>
                </li>
                <li class="group flex items-center gap-4 px-4 py-2 rounded-xl bg-gradient-to-r from-white to-blue-100 shadow hover:shadow-lg transition">
                    <div class="w-2 h-8 bg-pink-500 rounded-full"></div>
                    <div>
                        <h3 class="font-bold text-gray-800 group-hover:text-pink-600">
                            <a href="#" onclick="goToSection('constraints')">
                                Constraints
                            </a>
                        </h3>
                    </div>
                </li>
                <li class="group flex items-center gap-4 px-4 py-2 rounded-xl bg-gradient-to-r from-white to-blue-100 shadow hover:shadow-lg transition">
                    <div class="w-2 h-8 bg-pink-500 rounded-full"></div>
                    <div>
                        <h3 class="font-bold text-gray-800 group-hover:text-pink-600">
                            <a href="#" onclick="goToSection('refrences')">
                                Refrences
                            </a>
                        </h3>
                    </div>
                </li>
                <li class="group flex items-center gap-4 px-4 py-2 rounded-xl bg-gradient-to-r from-white to-blue-100 shadow hover:shadow-lg transition">
                    <div class="w-2 h-8 bg-slate-500 rounded-full"></div>
                    <div>
                        <h3 class="font-bold text-gray-800 group-hover:text-slate-600">
                            <a href="#" onclick="goToSection('sample-db')">
                                Run Query
                            </a>
                        </h3>
                    </div>
                </li>

            </ul>
        </div>


    </div>

</div>

<script>
    function runQuery() {
        let query =
            document.getElementById(
                "query"
            ).value;
        fetch(
                "{{ route('execute.query') }}", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": document
                            .querySelector(
                                'meta[name="csrf-token"]'
                            ).content
                    },
                    body: JSON.stringify({
                        query: query
                    })
                }
            )
            .then(
                res => res.json()
            )
            .then(
                response => {
                    let html = "";
                    if (!response.success) {
                        html =
                            `
                                <div class="bg-red-200 p-4">
                                ${response.error}
                                </div>`;

                    } else if (
                        response.type == "table"
                    ) {
                        let rows = response.data;
                        if (rows.length == 0) {
                            html = "No data";
                        } else {
                            html +=
                                `
                                    <table class="border w-full">
                                    <thead>
                                    <tr>`;

                            Object.keys(rows[0])
                                .forEach(
                                    (col) => {
                                        html +=
                                            `
                                                <th class="border p-3">
                                                ${col}
                                                </th>`;
                                    });
                            html +=
                                `
                                    </tr>
                                    </thead>
                                    <tbody>`;
                            rows.forEach(
                                (row) => {
                                    html += "<tr>";
                                    Object.values(row)
                                        .forEach(
                                            (value) => {
                                                html += `
                                                    <td class="border p-3">
                                                    ${value}
                                                    </td>`;
                                            });

                                    html += "</tr>";
                                });
                            html +=
                                `
                                 </tbody>
                                 </table>`;
                        }
                    } else {
                        html =
                            `
                                <div class="bg-green-200 p-4">
                                ${response.message}
                                <br>
                                Affected Rows:
                                ${response.affected_rows}
                                </div>`;

                    }
                    document
                        .getElementById(
                            "output"
                        )
                        .innerHTML = html;
                });
    }


    function goToSection(id) {
        const container = document.getElementById('content');
        const target = document.getElementById(id);

        container.scrollTo({
            top: target.offsetTop,
            behavior: 'smooth'
        });
    }
</script>


@endsection