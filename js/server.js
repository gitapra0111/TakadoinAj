const express = require('express');
const mysql = require('mysql2/promise');
const bcrypt = require('bcrypt');
const jwt = require('jsonwebtoken');
const cors = require('cors');
const app = express();

app.use(cors());
app.use(express.json());
app.use(express.static('public')); // Serve static files (e.g., images, HTML)

const dbConfig = {
    host: 'localhost',
    user: 'root',
    password: 'your_password',
    database: 'toko_bunga'
};

const JWT_SECRET = 'your_jwt_secret_key';

// Middleware to verify JWT
const authenticate = (req, res, next) => {
    const token = req.headers['authorization']?.split(' ')[1];
    if (!token) return res.status(401).json({ message: 'Unauthorized' });
    try {
        const decoded = jwt.verify(token, JWT_SECRET);
        req.user = decoded;
        next();
    } catch (error) {
        res.status(401).json({ message: 'Invalid token' });
    }
};

// Admin Login
app.post('/api/login', async (req, res) => {
    const { username, password } = req.body;
    try {
        const connection = await mysql.createConnection(dbConfig);
        const [rows] = await connection.execute('SELECT * FROM admins WHERE username = ?', [username]);
        if (rows.length === 0) return res.status(401).json({ message: 'Invalid credentials' });

        const admin = rows[0];
        const isMatch = await bcrypt.compare(password, admin.password);
        if (!isMatch) return res.status(401).json({ message: 'Invalid credentials' });

        const token = jwt.sign({ id: admin.id, username: admin.username }, JWT_SECRET, { expiresIn: '1h' });
        res.json({ token });
    } catch (error) {
        res.status(500).json({ message: 'Server error', error });
    }
});

// Get all products
app.get('/api/products', async (req, res) => {
    try {
        const connection = await mysql.createConnection(dbConfig);
        const [rows] = await connection.execute('SELECT * FROM products');
        res.json(rows);
    } catch (error) {
        res.status(500).json({ message: 'Server error', error });
    }
});

// Add a product (Admin only)
app.post('/api/products', authenticate, async (req, res) => {
    const { name, price, sale_price, image, is_sale, rating } = req.body;
    try {
        const connection = await mysql.createConnection(dbConfig);
        await connection.execute(
            'INSERT INTO products (name, price, sale_price, image, is_sale, rating) VALUES (?, ?, ?, ?, ?, ?)',
            [name, price, sale_price || null, image, is_sale, rating]
        );
        res.status(201).json({ message: 'Product added' });
    } catch (error) {
        res.status(500).json({ message: 'Server error', error });
    }
});

// Update a product (Admin only)
app.put('/api/products/:id', authenticate, async (req, res) => {
    const { id } = req.params;
    const { name, price, sale_price, image, is_sale, rating } = req.body;
    try {
        const connection = await mysql.createConnection(dbConfig);
        await connection.execute(
            'UPDATE products SET name = ?, price = ?, sale_price = ?, image = ?, is_sale = ?, rating = ? WHERE id = ?',
            [name, price, sale_price || null, image, is_sale, rating, id]
        );
        res.json({ message: 'Product updated' });
    } catch (error) {
        res.status(500).json({ message: 'Server error', error });
    }
});

// Delete a product (Admin only)
app.delete('/api/products/:id', authenticate, async (req, res) => {
    const { id } = req.params;
    try {
        const connection = await mysql.createConnection(dbConfig);
        await connection.execute('DELETE FROM products WHERE id = ?', [id]);
        res.json({ message: 'Product deleted' });
    } catch (error) {
        res.status(500).json({ message: 'Server error', error });
    }
});

app.listen(3000, () => console.log('Server running on port 3000'));