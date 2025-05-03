# 🗑️ Waste Management System

[![PHP Version](https://img.shields.io/badge/PHP-7.4%2B-blue.svg)](https://php.net)
[![MySQL Version](https://img.shields.io/badge/MySQL-5.7%2B-orange.svg)](https://mysql.com)
[![License](https://img.shields.io/badge/License-MIT-green.svg)](LICENSE)
[![Status](https://img.shields.io/badge/Status-Active-brightgreen.svg)]()

> A comprehensive waste management system that connects waste generators with waste management companies, facilitating efficient waste collection and disposal.

## 📸 Screenshots

### 🏠 Homepage
![Homepage](docs/screenshots/homepage.png)
*Modern and clean homepage with featured services and quick actions*

### 👤 User Dashboard
![User Dashboard](docs/screenshots/user-dashboard.png)
*User dashboard showing orders, profile, and quick actions*

### 🏢 Company Profile
![Company Profile](docs/screenshots/company-profile.png)
*Company profile page with services, locations, and reviews*

### 📦 Order Management
![Order Management](docs/screenshots/order-management.png)
*Order management interface for tracking and managing waste collection*

### 📱 Mobile Responsive
![Mobile View](docs/screenshots/mobile-view.png)
*Fully responsive design that works on all devices*

> 💡 **Note**: To add actual screenshots:
> 1. Create a `docs/screenshots` directory
> 2. Add your screenshots in PNG format
> 3. Name them as shown above
> 4. Update the paths in this README

## ✨ Features

- 👥 **User Management** - Admin, Companies, and Regular Users
- 🏢 **Company Registration** - Easy onboarding for waste management companies
- 📦 **Waste Order Management** - Track and manage waste collection orders
- 📍 **Location-based Services** - Find nearest waste management companies
- 📞 **Contact Management** - Direct communication between users and companies
- 📊 **Audit Logging** - Track all system activities
- 🎨 **Modern UI** - Responsive design for all devices

## 🛠️ System Requirements

| Component | Version |
|-----------|---------|
| PHP       | 7.4+    |
| MySQL     | 5.7+    |
| Web Server| Apache/Nginx |
| Composer  | Latest  |

## 🚀 Quick Start

```bash
# Clone the repository
git clone https://github.com/yourusername/waste-management-system.git
cd waste-management-system

# Create database
mysql -u root -p -e "CREATE DATABASE waste_mngt;"

# Import schema and data
mysql -u root -p waste_mngt < waste_mngt.sql
mysql -u root -p waste_mngt < setup_data.sql

# Configure database
cp config/database.example.php config/database.php
# Edit config/database.php with your credentials
```

## 👤 Default Users

### 🔑 Admin Account
| Field    | Value                    |
|----------|--------------------------|
| Email    | admin@wastemgmt.com      |
| Password | password                 |
| Role     | Admin                    |
| Status   | Active                   |

### 🏢 Company Accounts

#### 1. Clean Waste Solutions
| Field      | Value                    |
|------------|--------------------------|
| Email      | eco@cleanwaste.com       |
| Password   | password                 |
| Category   | Stationary Waste         |
| Location   | Nairobi                  |

#### 2. Green Recycling Co.
| Field      | Value                    |
|------------|--------------------------|
| Email      | info@greenrecycle.com    |
| Password   | password                 |
| Category   | Organic Waste            |
| Location   | Mombasa                  |

#### 3. Hazardous Waste Disposal
| Field      | Value                    |
|------------|--------------------------|
| Email      | contact@hazardousdisposal.com |
| Password   | password                 |
| Category   | Hazardous Waste          |
| Location   | Kisumu                   |

### 👥 Regular User Accounts

#### 1. John Doe
| Field      | Value                    |
|------------|--------------------------|
| Email      | john.doe@example.com     |
| Password   | password                 |
| Location   | Nairobi                  |

#### 2. Jane Smith
| Field      | Value                    |
|------------|--------------------------|
| Email      | jane.smith@example.com   |
| Password   | password                 |
| Location   | Mombasa                  |

## 📊 Database Structure

### Users Table (`users`)
| Column     | Type                     | Description            |
|------------|--------------------------|------------------------|
| user_id    | INT (PK)                | Unique identifier      |
| email      | VARCHAR(255) (UNIQUE)   | User's email           |
| password   | VARCHAR(255)            | Hashed password        |
| role       | ENUM                    | User role              |
| status     | ENUM                    | Account status         |
| created_at | TIMESTAMP               | Creation timestamp     |
| updated_at | TIMESTAMP               | Last update timestamp  |
| last_login | TIMESTAMP               | Last login timestamp   |

### User Profiles Table (`user_profiles`)
| Column     | Type                     | Description            |
|------------|--------------------------|------------------------|
| profile_id | INT (PK)                | Unique identifier      |
| user_id    | INT (FK)                | Linked user ID         |
| first_name | VARCHAR(50)             | User's first name      |
| last_name  | VARCHAR(50)             | User's last name       |
| phone      | VARCHAR(20)             | Contact number         |
| address    | VARCHAR(255)            | Physical address       |
| city       | VARCHAR(50)             | City                   |
| state      | VARCHAR(50)             | State/Province         |
| zip_code   | VARCHAR(20)             | Postal code            |

### Companies Table (`companies`)
| Column      | Type                     | Description            |
|-------------|--------------------------|------------------------|
| company_id  | INT (PK)                | Unique identifier      |
| user_id     | INT (FK)                | Linked user ID         |
| name        | VARCHAR(100)            | Company name           |
| category    | ENUM                    | Waste category         |
| description | TEXT                    | Company description    |
| logo        | VARCHAR(255)            | Logo path              |
| website     | VARCHAR(255)            | Company website        |

## 🔒 Security Features

### 1. 🔐 Password Security
- Bcrypt hashing
- Minimum 8 characters
- Special character requirements
- Regular password rotation

### 2. 👥 Role-Based Access
- Three-tier role system
- Granular permissions
- Session management
- IP-based restrictions

### 3. 📝 Audit System
- Comprehensive logging
- Change tracking
- User activity monitoring
- Security event logging

### 4. 🛡️ Data Protection
- Input sanitization
- SQL injection prevention
- XSS protection
- CSRF tokens

## 🔌 API Endpoints

### Authentication
| Method | Endpoint           | Description          |
|--------|--------------------|----------------------|
| POST   | /api/auth/login    | User login           |
| POST   | /api/auth/register | New user registration|
| POST   | /api/auth/logout   | User logout          |

### Users
| Method | Endpoint          | Description          |
|--------|-------------------|----------------------|
| GET    | /api/users        | List all users       |
| GET    | /api/users/{id}   | Get user details     |
| PUT    | /api/users/{id}   | Update user          |
| DELETE | /api/users/{id}   | Delete user          |

### Companies
| Method | Endpoint              | Description          |
|--------|-----------------------|----------------------|
| GET    | /api/companies        | List all companies   |
| GET    | /api/companies/{id}   | Get company details  |
| POST   | /api/companies        | Create company       |
| PUT    | /api/companies/{id}   | Update company       |
| DELETE | /api/companies/{id}   | Delete company       |

## 🤝 Contributing

1. Fork the repository
2. Create your feature branch (`git checkout -b feature/AmazingFeature`)
3. Commit your changes (`git commit -m 'Add some AmazingFeature'`)
4. Push to the branch (`git push origin feature/AmazingFeature`)
5. Open a Pull Request

## 📄 License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.

## 💬 Support

For support, email support@wastemgmt.com or create an issue in the GitHub repository.

## 🙏 Acknowledgments

- Thanks to all contributors
- Special thanks to the development team
- Inspired by the need for better waste management solutions

