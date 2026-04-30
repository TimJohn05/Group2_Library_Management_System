<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-theme="dark">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="A modern library management system for organizing your book collections with ease.">

    <title>LibManager — Library Management System</title>

    <link rel="stylesheet" href="/css/app.css">
</head>
<body>
    <!-- Animated Background Particles -->
    <div class="bg-particles" id="bg-particles"></div>

    <div class="app-wrapper">
        <!-- Navbar -->
        <nav class="navbar">
            <div class="container">
                <div class="logo">
                    <div class="logo-icon">📚</div>
                    <span class="logo-text">LibManager</span>
                </div>
                <div class="nav-right">
                    <div id="auth-nav"></div>
                    <button class="theme-toggle" id="theme-toggle" title="Toggle theme" aria-label="Toggle dark/light mode"></button>
                </div>
            </div>
        </nav>

        <!-- Auth Section -->
        <section id="auth-section" class="hidden">
            <div class="auth-wrapper">
                <div class="auth-container">
                    <!-- Branding Panel -->
                    <div class="auth-brand">
                        <div class="brand-icon">📖</div>
                        <h2>Welcome Back</h2>
                        <p>Manage your entire library collection in one beautiful, intuitive dashboard.</p>
                    </div>

                    <!-- Form Panel -->
                    <div class="auth-form-panel">
                        <div class="auth-tabs">
                            <button class="auth-tab active" id="tab-login" type="button">Sign In</button>
                            <button class="auth-tab" id="tab-register" type="button">Register</button>
                        </div>

                        <!-- Login Form -->
                        <div class="form-card" id="login-card">
                            <form id="login-form">
                                <div class="form-group">
                                    <label for="login-email">Email Address</label>
                                    <div class="input-wrapper">
                                        <input type="email" id="login-email" class="form-input" required placeholder="you@example.com">
                                        <span class="input-icon">✉</span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="login-password">Password</label>
                                    <div class="input-wrapper">
                                        <input type="password" id="login-password" class="form-input" required placeholder="••••••••">
                                        <span class="input-icon">🔒</span>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary">Sign In →</button>
                            </form>
                        </div>

                        <!-- Register Form -->
                        <div class="form-card hidden" id="register-card">
                            <form id="register-form">
                                <div class="form-group">
                                    <label for="reg-name">Full Name</label>
                                    <div class="input-wrapper">
                                        <input type="text" id="reg-name" class="form-input" required placeholder="John Doe">
                                        <span class="input-icon">👤</span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="reg-email">Email Address</label>
                                    <div class="input-wrapper">
                                        <input type="email" id="reg-email" class="form-input" required placeholder="john@example.com">
                                        <span class="input-icon">✉</span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="reg-password">Password</label>
                                    <div class="input-wrapper">
                                        <input type="password" id="reg-password" class="form-input" required minlength="8" placeholder="••••••••">
                                        <span class="input-icon">🔒</span>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary">Create Account →</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Management Section -->
        <section id="management-section" class="hidden">
            <div class="container main-content">
                <div class="stats-grid" id="stats-container">
                    <div class="stat-card">
                        <div class="stat-value" id="stat-total-books">0</div>
                        <div class="stat-label">Total Books</div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">
                        <h2>📚 Books Collection</h2>
                        <div class="card-actions">
                            <select id="filter-author" class="filter-select">
                                <option value="">All Authors</option>
                            </select>
                            <select id="filter-category" class="filter-select">
                                <option value="">All Categories</option>
                            </select>
                            <button id="add-book-btn" class="btn btn-primary" style="width:auto; padding: 0.6rem 1.2rem;">+ Add Book</button>
                        </div>
                    </div>

                    <div class="table-wrap">
                        <table>
                            <thead>
                                <tr>
                                    <th>Title</th>
                                    <th>Author</th>
                                    <th>Category</th>
                                    <th>Year</th>
                                    <th>ISBN</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody id="books-table-body"></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <!-- Modal for Add/Edit Book -->
    <div id="book-modal" class="modal hidden">
        <div class="modal-content">
            <h2 id="modal-title">Add New Book</h2>
            <form id="book-form">
                <input type="hidden" id="book-id">
                <div class="form-group">
                    <label for="book-title">Title</label>
                    <input type="text" id="book-title" class="form-input" required>
                </div>
                <div class="form-group">
                    <label for="book-author">Author</label>
                    <select id="book-author" required>
                        <option value="">Select Author</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="book-category">Category</label>
                    <select id="book-category" required>
                        <option value="">Select Category</option>
                    </select>
                </div>
                <div class="modal-grid">
                    <div class="form-group">
                        <label for="book-year">Published Year</label>
                        <input type="number" id="book-year" class="form-input">
                    </div>
                    <div class="form-group">
                        <label for="book-isbn">ISBN</label>
                        <input type="text" id="book-isbn" class="form-input">
                    </div>
                </div>
                <div class="modal-actions">
                    <button type="button" id="close-modal" class="btn btn-outline">Cancel</button>
                    <button type="submit" class="btn btn-primary" style="width:auto;">Save Book</button>
                </div>
            </form>
        </div>
    </div>

    <div id="notification" class="hidden"></div>

    <script>
        // ===== Theme Toggle =====
        const themeToggle = document.getElementById('theme-toggle');
        const html = document.documentElement;
        const savedTheme = localStorage.getItem('theme') || 'dark';
        html.setAttribute('data-theme', savedTheme);

        themeToggle.addEventListener('click', () => {
            const current = html.getAttribute('data-theme');
            const next = current === 'dark' ? 'light' : 'dark';
            html.setAttribute('data-theme', next);
            localStorage.setItem('theme', next);
        });

        // ===== Background Particles =====
        (function createParticles() {
            const container = document.getElementById('bg-particles');
            const colors = ['rgba(99,102,241,0.3)', 'rgba(139,92,246,0.25)', 'rgba(167,139,250,0.2)'];
            for (let i = 0; i < 20; i++) {
                const particle = document.createElement('div');
                particle.classList.add('particle');
                const size = Math.random() * 4 + 2;
                particle.style.width = size + 'px';
                particle.style.height = size + 'px';
                particle.style.left = Math.random() * 100 + '%';
                particle.style.background = colors[Math.floor(Math.random() * colors.length)];
                particle.style.animationDuration = (Math.random() * 15 + 15) + 's';
                particle.style.animationDelay = (Math.random() * 15) + 's';
                container.appendChild(particle);
            }
        })();

        // ===== Auth Tab Switching =====
        const tabLogin = document.getElementById('tab-login');
        const tabRegister = document.getElementById('tab-register');
        const loginCard = document.getElementById('login-card');
        const registerCard = document.getElementById('register-card');

        tabLogin.addEventListener('click', () => {
            tabLogin.classList.add('active');
            tabRegister.classList.remove('active');
            loginCard.classList.remove('hidden');
            registerCard.classList.add('hidden');
        });

        tabRegister.addEventListener('click', () => {
            tabRegister.classList.add('active');
            tabLogin.classList.remove('active');
            registerCard.classList.remove('hidden');
            loginCard.classList.add('hidden');
        });

        // ===== App Logic =====
        const API_URL = '/api';
        let currentUser = null;
        let authors = [];
        let categories = [];

        const authSection = document.getElementById('auth-section');
        const managementSection = document.getElementById('management-section');
        const authNav = document.getElementById('auth-nav');
        const booksTableBody = document.getElementById('books-table-body');
        const bookModal = document.getElementById('book-modal');
        const bookForm = document.getElementById('book-form');
        const notification = document.getElementById('notification');
        const filterAuthor = document.getElementById('filter-author');
        const filterCategory = document.getElementById('filter-category');

        document.addEventListener('DOMContentLoaded', async () => {
            await checkAuth();
            setupEventListeners();
        });

        async function checkAuth() {
            try {
                const response = await fetch(`${API_URL}/session-check`);
                const data = await response.json();
                if (data.authenticated) {
                    currentUser = data.user;
                    showAuthenticatedUI();
                } else {
                    showUnauthenticatedUI();
                }
            } catch (error) {
                console.error('Auth check failed', error);
                showUnauthenticatedUI();
            }
        }

        function showAuthenticatedUI() {
            authSection.classList.add('hidden');
            managementSection.classList.remove('hidden');
            authNav.innerHTML = `
                <span class="user-greeting">Hi, <strong>${currentUser.name}</strong></span>
                <button id="logout-btn" class="btn-logout">Logout</button>
            `;
            document.getElementById('logout-btn').onclick = logout;
            loadDashboardData();
        }

        function showUnauthenticatedUI() {
            authSection.classList.remove('hidden');
            managementSection.classList.add('hidden');
            authNav.innerHTML = `<span class="badge">Please sign in</span>`;
        }

        function setupEventListeners() {
            document.getElementById('login-form').onsubmit = async (e) => {
                e.preventDefault();
                await login(
                    document.getElementById('login-email').value,
                    document.getElementById('login-password').value
                );
            };

            document.getElementById('register-form').onsubmit = async (e) => {
                e.preventDefault();
                await register(
                    document.getElementById('reg-name').value,
                    document.getElementById('reg-email').value,
                    document.getElementById('reg-password').value
                );
            };

            document.getElementById('add-book-btn').onclick = () => {
                document.getElementById('modal-title').innerText = 'Add New Book';
                bookForm.reset();
                document.getElementById('book-id').value = '';
                bookModal.classList.remove('hidden');
            };

            document.getElementById('close-modal').onclick = () => {
                bookModal.classList.add('hidden');
            };

            bookForm.onsubmit = async (e) => {
                e.preventDefault();
                const bookId = document.getElementById('book-id').value;
                const bookData = {
                    title: document.getElementById('book-title').value,
                    author_id: document.getElementById('book-author').value,
                    category_id: document.getElementById('book-category').value,
                    published_year: document.getElementById('book-year').value,
                    isbn: document.getElementById('book-isbn').value,
                };
                if (bookId) {
                    await updateBook(bookId, bookData);
                } else {
                    await createBook(bookData);
                }
            };

            filterAuthor.onchange = async () => {
                filterCategory.value = '';
                const authorId = filterAuthor.value;
                const books = authorId
                    ? await apiRequest(`/books/author/${authorId}`)
                    : await apiRequest('/books');
                renderBooks(books);
            };

            filterCategory.onchange = async () => {
                filterAuthor.value = '';
                const categoryId = filterCategory.value;
                const books = categoryId
                    ? await apiRequest(`/books/category/${categoryId}`)
                    : await apiRequest('/books');
                renderBooks(books);
            };
        }

        async function apiRequest(endpoint, method = 'GET', body = null) {
            const options = {
                method,
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                }
            };
            if (body) options.body = JSON.stringify(body);
            const response = await fetch(`${API_URL}${endpoint}`, options);
            if (!response.ok) {
                const errorData = await response.json();
                throw new Error(errorData.message || 'API request failed');
            }
            return response.json();
        }

        async function login(email, password) {
            try {
                const data = await apiRequest('/login', 'POST', { email, password });
                currentUser = data.user;
                notify('Login successful!', 'success');
                showAuthenticatedUI();
            } catch (error) {
                notify(error.message, 'error');
            }
        }

        async function register(name, email, password) {
            try {
                const data = await apiRequest('/register', 'POST', { name, email, password });
                currentUser = data.user;
                notify('Registration successful!', 'success');
                showAuthenticatedUI();
            } catch (error) {
                notify(error.message, 'error');
            }
        }

        async function logout() {
            try {
                await apiRequest('/logout', 'POST');
                currentUser = null;
                notify('Logged out', 'success');
                showUnauthenticatedUI();
            } catch (error) {
                notify('Logout failed', 'error');
            }
        }

        async function loadDashboardData() {
            try {
                const [books, authorsList, categoriesList, analytics] = await Promise.all([
                    apiRequest('/books'),
                    apiRequest('/authors'),
                    apiRequest('/categories'),
                    apiRequest('/analytics')
                ]);
                authors = authorsList;
                categories = categoriesList;
                updateStats(analytics);
                populateDropdowns();
                renderBooks(books);
            } catch (error) {
                notify('Failed to load data', 'error');
            }
        }

        function updateStats(analytics) {
            document.getElementById('stat-total-books').innerText = analytics.total_books;
        }

        function populateDropdowns() {
            const authorSelect = document.getElementById('book-author');
            const catSelect = document.getElementById('book-category');
            authorSelect.innerHTML = '<option value="">Select Author</option>' +
                authors.map(a => `<option value="${a.id}">${a.name}</option>`).join('');
            catSelect.innerHTML = '<option value="">Select Category</option>' +
                categories.map(c => `<option value="${c.id}">${c.name}</option>`).join('');
            filterAuthor.innerHTML = '<option value="">All Authors</option>' +
                authors.map(a => `<option value="${a.id}">${a.name}</option>`).join('');
            filterCategory.innerHTML = '<option value="">All Categories</option>' +
                categories.map(c => `<option value="${c.id}">${c.name}</option>`).join('');
        }

        function renderBooks(books) {
            if (books.length === 0) {
                booksTableBody.innerHTML = '<tr><td colspan="6" style="text-align:center; color:var(--text-muted); padding:2rem;">No books found in this collection.</td></tr>';
                return;
            }
            booksTableBody.innerHTML = books.map(book => `
                <tr>
                    <td><strong>${book.title}</strong></td>
                    <td>${book.author ? book.author.name : 'Unknown'}</td>
                    <td><span class="badge">${book.category ? book.category.name : 'N/A'}</span></td>
                    <td>${book.published_year || '-'}</td>
                    <td><small>${book.isbn || '-'}</small></td>
                    <td>
                        <div class="actions">
                            <button class="btn btn-outline btn-sm" onclick="editBook(${book.id})">Edit</button>
                            <button class="btn btn-danger btn-sm" onclick="deleteBook(${book.id})">Delete</button>
                        </div>
                    </td>
                </tr>
            `).join('');
        }

        async function createBook(data) {
            try {
                await apiRequest('/books', 'POST', data);
                notify('Book added successfully', 'success');
                bookModal.classList.add('hidden');
                loadDashboardData();
            } catch (error) {
                notify(error.message, 'error');
            }
        }

        async function updateBook(id, data) {
            try {
                await apiRequest(`/books/${id}`, 'PUT', data);
                notify('Book updated successfully', 'success');
                bookModal.classList.add('hidden');
                loadDashboardData();
            } catch (error) {
                notify(error.message, 'error');
            }
        }

        async function deleteBook(id) {
            if (!confirm('Are you sure you want to delete this book?')) return;
            try {
                await apiRequest(`/books/${id}`, 'DELETE');
                notify('Book deleted', 'success');
                loadDashboardData();
            } catch (error) {
                notify(error.message, 'error');
            }
        }

        async function editBook(id) {
            try {
                const book = await apiRequest(`/books/${id}`);
                document.getElementById('modal-title').innerText = 'Edit Book';
                document.getElementById('book-id').value = book.id;
                document.getElementById('book-title').value = book.title;
                document.getElementById('book-author').value = book.author_id;
                document.getElementById('book-category').value = book.category_id;
                document.getElementById('book-year').value = book.published_year || '';
                document.getElementById('book-isbn').value = book.isbn || '';
                bookModal.classList.remove('hidden');
            } catch (error) {
                notify('Failed to load book details', 'error');
            }
        }

        function notify(message, type) {
            notification.innerText = message;
            notification.className = `notify-${type}`;
            notification.classList.remove('hidden');
            setTimeout(() => { notification.classList.add('hidden'); }, 3000);
        }
    </script>
</body>
</html>
