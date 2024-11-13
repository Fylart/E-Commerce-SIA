-- nagcreate aq database kasi di q alam anong database gamit for the whole site
CREATE DATABASE IF NOT EXISTS PaymentDB;

-- di q alam anong database gamit, palitan na lang to sa name ng database
USE PaymentDB;

-- Table for storing user contact information
CREATE TABLE IF NOT EXISTS users (
    user_id INT AUTO_INCREMENT PRIMARY KEY,
    contact_info VARCHAR(255) NOT NULL,  
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Table for storing delivery information
CREATE TABLE IF NOT EXISTS delivery_info (
    delivery_id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,  
    region VARCHAR(100),
    first_name VARCHAR(100),
    last_name VARCHAR(100),
    address VARCHAR(255),
    apartment VARCHAR(255),
    postal_code VARCHAR(20),
    city VARCHAR(100),
    phone VARCHAR(20),
    FOREIGN KEY (user_id) REFERENCES users(user_id),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Table for storing payment methods
CREATE TABLE IF NOT EXISTS payment_methods (
    payment_id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,  -- Foreign key reference to users table
    payment_method VARCHAR(50),  
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id)
);

-- Table for storing order information
CREATE TABLE IF NOT EXISTS orders (
    order_id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,  -
    total_amount DECIMAL(10, 2) NOT NULL,  -- Total order amount
    status VARCHAR(50) DEFAULT 'Pending', 
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id)
);

-- Table for storing order items
CREATE TABLE IF NOT EXISTS order_items (
    order_item_id INT AUTO_INCREMENT PRIMARY KEY,
    order_id INT NOT NULL,  -- Foreign key reference to orders table
    product_name VARCHAR(255),
    product_price DECIMAL(10, 2),
    quantity INT,
    FOREIGN KEY (order_id) REFERENCES orders(order_id)
);
