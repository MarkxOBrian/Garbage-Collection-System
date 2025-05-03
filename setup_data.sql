-- Setup data for Waste Management System
-- This file contains default data for initial system setup

-- Insert default admin user
INSERT INTO `users` (`email`, `password`, `role`, `status`, `last_login`) 
VALUES ('admin@wastemgmt.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'admin', 'active', NOW());

-- Insert default companies
INSERT INTO `users` (`email`, `password`, `role`, `status`, `last_login`) 
VALUES 
('eco@cleanwaste.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'company', 'active', NOW()),
('info@greenrecycle.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'company', 'active', NOW()),
('contact@hazardousdisposal.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'company', 'active', NOW());

-- Insert company details
INSERT INTO `companies` (`user_id`, `name`, `category`, `description`, `website`) 
VALUES 
(2, 'Clean Waste Solutions', 'Stationary Waste', 'Professional waste management company specializing in paper and cardboard recycling.', 'https://cleanwaste.com'),
(3, 'Green Recycling Co.', 'Organic Waste', 'Leading provider of organic waste management and composting solutions.', 'https://greenrecycle.com'),
(4, 'Hazardous Waste Disposal', 'Hazardous Waste', 'Specialized in safe disposal of hazardous materials and electronic waste.', 'https://hazardousdisposal.com');

-- Insert company locations
INSERT INTO `company_locations` (`company_id`, `address`, `city`, `state`, `zip_code`, `latitude`, `longitude`, `is_primary`) 
VALUES 
(1, '123 Recycling Ave', 'Nairobi', 'Nairobi', '00100', -1.2921, 36.8219, 1),
(2, '456 Green Street', 'Mombasa', 'Mombasa', '80100', -4.0435, 39.6682, 1),
(3, '789 Safety Lane', 'Kisumu', 'Kisumu', '40100', -0.1022, 34.7617, 1);

-- Insert default regular users
INSERT INTO `users` (`email`, `password`, `role`, `status`, `last_login`) 
VALUES 
('john.doe@example.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'user', 'active', NOW()),
('jane.smith@example.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'user', 'active', NOW());

-- Insert user profiles
INSERT INTO `user_profiles` (`user_id`, `first_name`, `last_name`, `phone`, `address`, `city`, `state`, `zip_code`) 
VALUES 
(5, 'John', 'Doe', '+254712345678', '101 Main Street', 'Nairobi', 'Nairobi', '00100'),
(6, 'Jane', 'Smith', '+254723456789', '202 Park Road', 'Mombasa', 'Mombasa', '80100');

-- Insert sample waste orders
INSERT INTO `waste_orders` (`user_id`, `company_id`, `waste_type`, `quantity`, `unit`, `description`, `status`, `scheduled_date`) 
VALUES 
(5, 1, 'Stationary Waste', 50.00, 'kg', 'Paper and cardboard waste from office cleanup', 'pending', DATE_ADD(NOW(), INTERVAL 2 DAY)),
(6, 2, 'Organic Waste', 100.00, 'kg', 'Food waste from restaurant', 'confirmed', DATE_ADD(NOW(), INTERVAL 3 DAY));

-- Insert sample contact messages
INSERT INTO `contact_messages` (`name`, `email`, `subject`, `message`, `status`) 
VALUES 
('Robert Johnson', 'robert@example.com', 'Inquiry about recycling services', 'I would like to know more about your recycling services for our office building.', 'new'),
('Sarah Williams', 'sarah@example.com', 'Request for hazardous waste disposal', 'We need to dispose of some electronic waste from our IT department.', 'new');

-- Insert sample audit logs
INSERT INTO `audit_logs` (`user_id`, `action`, `table_name`, `record_id`, `old_values`, `new_values`) 
VALUES 
(1, 'create', 'users', 1, NULL, '{"email":"admin@wastemgmt.com","role":"admin"}'),
(1, 'create', 'companies', 1, NULL, '{"name":"Clean Waste Solutions","category":"Stationary Waste"}'); 