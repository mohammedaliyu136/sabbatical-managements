Product Requirements Document: Sabbatical Tracker
Version: 1.0
Status: In Development
Last Updated: July 29, 2025

1. Introduction
1.1. Overview

The Sabbatical Tracker is a web-based application designed to streamline the management and monitoring of professional sabbaticals for doctors within a hospital or clinic. It provides a centralized platform for administrators to manage sabbatical records and for doctors to provide periodic updates on their progress, ensuring transparency and simplifying record-keeping.

1.2. Purpose & Goals

The primary goal of this application is to replace manual or disparate tracking methods with a secure, user-friendly, and efficient digital solution.

For Administration: To maintain a clear, real-time overview of all ongoing and upcoming sabbaticals, including key details and progress reports.

For Doctors: To provide a simple and direct way to fulfill their reporting obligations while on sabbatical.

Overall: To improve administrative efficiency, ensure compliance with professional development policies, and maintain a connection with staff during their leave.

2. Target Audience & User Roles
The application will serve two primary user roles with distinct permissions and workflows:

Administrator: Typically a member of the hospital or clinic's administrative staff. This user has full oversight of the system.

Doctor: A physician who has been approved for a professional sabbatical. This user has limited access, focused on their own record.

3. User Stories
3.1. Administrator Stories

As an Admin, I want to securely log in to the system so that I can access the administrative dashboard.

As an Admin, I want to view a list of all sabbaticals (upcoming, active, and completed) so that I have a complete overview of staff leave.

As an Admin, I want to create a new sabbatical record for a doctor so that I can officially log their approved leave in the system.

As an Admin, I want to view the detailed page for any sabbatical so that I can review its purpose, duration, and all associated progress reports.

As an Admin, I want to edit or update the details of a sabbatical record so that I can correct errors or reflect changes in the plan.

3.2. Doctor Stories

As a Doctor, I want to securely log in to the system so that I can access my personal sabbatical information.

As a Doctor, I want to view a dashboard showing only my own sabbatical so that I can easily find my record.

As a Doctor, I want to view the full details of my sabbatical so that I can reference its terms and timeline.

As a Doctor, I want to submit a progress report so that I can fulfill my reporting requirements.

As a Doctor, I want to see a chronological list of my past reports so that I have a record of my submissions.

4. Features & Functionality
4.1. Core System

User Authentication: Secure user registration and login system with password protection.

Role-Based Access Control (RBAC): The system will strictly enforce permissions based on whether the user is an 'Admin' or a 'Doctor'.

4.2. Administrator Dashboard & Sabbatical Management

Dashboard View: A comprehensive table or list view of all sabbatical records, showing key information like Doctor's Name, Destination, and End Date.

CRUD Functionality:

Create: A dedicated form for admins to add a new sabbatical record. Fields will include: Doctor selection, Destination, Purpose, Start Date, End Date, and required Update Frequency.

Read: Ability to view all details for any sabbatical.

Update: Ability to edit existing sabbatical records.

Delete: Ability to remove sabbatical records.

4.3. Doctor View & Progress Reporting

Personalized Dashboard: A simplified view showing only the logged-in doctor's assigned sabbatical.

Detailed Sabbatical View: A read-only view of the doctor's sabbatical details.

Progress Report Submission: A simple form on the detail page for the doctor to write and submit a progress report.

Report History: A chronologically sorted list of all submitted reports for that sabbatical, displayed on the detail page.

4.4. UI/UX & Notifications

Flash Messages: The system will provide clear on-screen feedback for actions (e.g., "Sabbatical created successfully," "Progress report submitted").

Responsive Design: The user interface will be fully responsive and functional on desktop and mobile devices.

Date Formatting: All dates will be displayed in a consistent, human-readable format (e.g., Jul 29, 2025).

5. Technical Requirements
Backend Framework: Laravel

Database: MySQL

Frontend Templating: Laravel Blade with HTML

Styling: Tailwind CSS

Authentication: Laravel's native authentication scaffolding (Breeze or similar).

6. Data Model
The database will consist of three primary tables:

users: Stores user account information, including a boolean is_admin flag for role management.

sabbaticals: Stores all information related to a single sabbatical and is linked to a user via a foreign key (user_id).

progress_reports: Stores individual report entries and is linked to a sabbatical via a foreign key (sabbatical_id).

7. Security & Authorization
All application routes (except login/registration) will require authentication.

Admin Authorization: CRUD operations on sabbaticals (create, update, delete) will be restricted to users with the is_admin flag, enforced via a Laravel Gate.

Doctor Authorization: Doctors will only be able to view their own sabbatical details and submit progress reports to it. They cannot view or modify other doctors' records. This will be enforced via a Laravel Policy.

8. Acceptance Criteria
Authentication: Users can register, log in, and log out. Access is denied without logging in.

Admin Role: An admin user can log in and perform all CRUD operations on sabbatical records for any doctor.

Doctor Role: A doctor user can log in, view their assigned sabbatical, and submit progress reports. They are blocked from viewing other records or accessing admin functions.

Data Integrity: Progress reports are correctly associated with the correct sabbatical and user.

Usability: The interface is intuitive, provides clear feedback for actions, and is usable on mobile devices.

