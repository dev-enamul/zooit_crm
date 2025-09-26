<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ProjectProposal;
use App\Models\ProjectProposalSection;
use App\Models\Customer;
use App\Models\User;

class ProjectProposalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $customer = Customer::first();
        $user = User::find($customer->user_id);

        $projectProposal = ProjectProposal::create([
            'customer_id' => $customer->id,
            'user_id' => $user->id,
            'title' => 'Ecommerce Proposal - Mondol Group',
            'submitted_by' => 'ZOOM IT',
            'address' => '#347, Concept Tower, 68-69, Green Rd, Dhaka 1209',
            'date' => '2025-09-23',
        ]);

        $projectProposal->sections()->createMany([
            [
                'title' => 'Introduction',
                'value' => [
                    'content' => '<p>ZOOM IT is a premier IT company specializing in the development of cutting-edge custom Ecommerce & ERP software solutions. With a decade of industry experience, we have established ourselves as leaders in delivering robust digital solutions that drive business growth.</p><div class="highlight-box"><p>Our team works closely with clients to understand their unique requirements, providing flawless business solutions that align with strategic objectives. Our mantra is based on mutual growth, and we have a portfolio of successful business associations that attest to our work efficiency and quality.</p></div><p>We primarily work with custom platforms and advanced tools for designing and developing corporate solutions. With our experienced team, we design solutions on time, every time, ensuring your ecommerce platform becomes a competitive advantage.</p>'
                ],
            ],
            [
                'title' => 'Key Facilities',
                'value' => [
                    'items' => [
                        '<strong>Modern UI/UX</strong> – Clean, attractive, and intuitive user interface designed for optimal customer experience.',
                        '<strong>Ultra-Secure Platform</strong> – End-to-end encryption and enterprise-level data protection protocols.',
                        '<strong>Super-Fast Performance</strong> – Optimized for speed with CDN, caching, and microservices architecture.',
                        '<strong>Mobile Responsive</strong> – Seamless experience across all devices - desktop, tablet, and mobile.',
                        '<strong>AI Powered Search</strong> – Smart product search with auto-suggestions and intelligent filters.',
                        '<strong>Global Support</strong> – Multi-language and multi-currency support for international customers.',
                        '<strong>Scalable Architecture</strong> – Capable of handling future growth and millions of products.',
                        '<strong>Custom Modules</strong> – Flexible architecture to add new features easily.',
                    ]
                ],
            ],
            [
                'title' => 'Security Features',
                'value' => [
                    'content' => '<p>We implement enterprise-grade security measures to protect your business and customer data:</p>',
                    'items' => [
                        'Secure Back-Office Access with multi-factor authentication',
                        'SSL Compatibility for encrypted data transmission',
                        'Unique Access Tokens for different system components',
                        'PCI DSS Compliant payment handling',
                        'Advanced protection against XSS, CSRF, SQL injection attacks',
                        'Encrypted Passwords & Cookies for data protection',
                        'Role-Based Admin Access with comprehensive audit trails',
                        'Password Recovery Protection with attempt limiting',
                        'Email Security with headers injections blocked',
                    ]
                ],
            ],
            [
                'title' => 'Administration & Management',
                'value' => [
                    'content' => '<p>Our comprehensive admin panel provides complete control over your ecommerce operations:</p>',
                    'items' => [
                        'Smart Back-Office Search for quick product, order, and customer lookup',
                        'Content Management System (CMS) for banners, categories, offers, and blogs',
                        'Advanced Inventory Management with stock level alerts and warehouse integration',
                        'Automated Database Backup & Restore functionality',
                        'Advanced Analytics & Reporting for sales, orders, refunds, and customer insights',
                        'Maintenance Mode for safe updates without downtime',
                    ]
                ],
            ],
            [
                'title' => 'Key Features',
                'value' => [
                    'sub_sections' => [
                        [
                            'title' => 'Core Modules',
                            'items' => [
                                '<strong>Product Management</strong> – Add, edit, categorize products with images & variants.',
                                '<strong>Customer Management</strong> – Profiles, addresses, purchase history, loyalty points.',
                                '<strong>Cart & Checkout System</strong> – Multi-step checkout with guest login option.',
                                '<strong>Order Management</strong> – Track pending, shipped, delivered, and returned orders.',
                                '<strong>Payment Integration</strong> – Multiple gateways (SSLCommerz, Stripe).',
                                '<strong>Shipping Management</strong> – Multiple courier integration with tracking system.',
                                '<strong>Discounts & Coupons</strong> – Advanced promotional features.',
                                '<strong>Inventory & Stock Management</strong> – Automated stock deduction on sales.',
                                '<strong>Tax & VAT Module</strong> – Country-specific taxation system.',
                            ]
                        ],
                        [
                            'title' => 'Advanced Features',
                            'items' => [
                                'Multi-language and multi-currency support',
                                'AI-driven recommendation engine',
                                'Wishlist & Save for Later functionality',
                                'Product reviews & ratings system',
                                'Push notifications for engagement',
                                'Email & SMS notifications for orders, delivery, and promotions',
                                'Role-based access for Admin, Manager, Seller, and Customer',
                                'Marketplace module (optional) – Allow third-party sellers',
                                'SEO optimized product pages',
                                'Mobile App API ready architecture',
                            ]
                        ]
                    ]
                ],
            ],
            [
                'title' => 'Technical Approach',
                'value' => [
                    'sub_sections' => [
                        [
                            'title' => 'Option 1: MERN Stack',
                            'sub_sections' => [
                                [
                                    'title' => 'Frontend:',
                                    'items' => [
                                        'Framework: React.js',
                                        'Language: JavaScript (ES6+)',
                                        'UI Library: Ant Design, Material-UI, or Tailwind CSS',
                                        'State Management: Redux Toolkit or Context API',
                                        'HTTP Requests: Axios',
                                    ]
                                ],
                                [
                                    'title' => 'Backend:',
                                    'items' => [
                                        'Runtime Environment: Node.js',
                                        'Web Framework: Express.js',
                                        'Language: JavaScript',
                                        'Database: MongoDB (NoSQL)',
                                    ]
                                ]
                            ]
                        ],
                        [
                            'title' => 'Option 2: Laravel with React',
                            'sub_sections' => [
                                [
                                    'title' => 'Frontend:',
                                    'items' => [
                                        'Framework: React.js',
                                        'Language: JavaScript (ES6+)',
                                        'UI Library: Ant Design, Material-UI, or Tailwind CSS',
                                        'State Management: Redux Toolkit or Context API',
                                        'HTTP Requests: Axios',
                                    ]
                                ],
                                [
                                    'title' => 'Backend:',
                                    'items' => [
                                        'Framework: Laravel',
                                        'Authentication: Laravel Sanctum / JWT',
                                        'Database: MySQL/PostgreSQL',
                                    ]
                                ]
                            ]
                        ]
                    ]
                ],
            ],
            [
                'title' => 'Project Plan',
                'value' => [
                    'content' => '<p>The project is divided into five development phases to ensure systematic progress and quality delivery:</p>',
                    'items' => [
                        '<strong>Planning</strong> – Define scope, gather requirements, and allocate resources',
                        '<strong>Analysis</strong> – Study workflows and prepare system specifications',
                        '<strong>Design</strong> – Create UI designs, database schemas, and module architecture',
                        '<strong>Development</strong> – Build modules with all core functionalities and security measures',
                        '<strong>Deployment</strong> – Test and deploy the system on a secure server',
                    ],
                    'timeline' => [
                        [
                            'date' => 'Month 1 – Planning & Design',
                            'description' => 'Requirement gathering & analysis, finalizing scope & technical architecture, UI/UX design preparation and approval.',
                        ],
                        [
                            'date' => 'Month 2 – Core Development',
                            'description' => 'Homepage, product catalog, product details, backend setup (Database, API, Authentication).',
                        ],
                        [
                            'date' => 'Month 3 – Feature Development',
                            'description' => 'Checkout system development, payment gateway integration, user account & profile management.',
                        ],
                        [
                            'date' => 'Month 4 – Advanced Modules',
                            'description' => 'AI features (recommendation, search, analytics), vendor module, marketing tools, notification system.',
                        ],
                        [
                            'date' => 'Month 5 – Testing & Optimization',
                            'description' => 'QA & bug fixing, security testing (vulnerability, penetration testing), performance optimization.',
                        ],
                        [
                            'date' => 'Month 6 – Deployment & Go-Live',
                            'description' => 'Server & hosting setup, production deployment, final launch & monitoring.',
                        ],
                    ]
                ],
            ],
            [
                'title' => 'Costing Breakdown',
                'value' => [
                    'content' => '<p>The following cost breakdown is based on the information currently available. Costing covers Planning, Analysis, Design, Development, & Deployment of the proposed project.</p><div class="highlight-box"><p><strong>Note:</strong> The costing is subject to change if new requirements are added during the development phase.</p></div>',
                    'payment_terms' => [
                        '50% of the total cost upon acceptance of the Proposal along with work order',
                        '25% after completion of Frontend Design',
                        '25% on final delivery after testing, QA, security, and deployment',
                    ],
                    'core_features' => [
                        ['functionality' => 'PRD', 'frontend_price' => '', 'backend_price' => '20,000 BDT', 'note' => 'One Time'],
                        ['functionality' => 'UI/UX Design', 'frontend_price' => '3,00,000 BDT', 'backend_price' => '', 'note' => 'One Time'],
                        ['functionality' => 'FSD', 'frontend_price' => '', 'backend_price' => '20,000 BDT', 'note' => 'One Time'],
                        ['functionality' => 'ER Diagram', 'frontend_price' => '', 'backend_price' => '50,000 BDT', 'note' => 'One Time'],
                        ['functionality' => 'Product Catalog', 'frontend_price' => '70,000 BDT', 'backend_price' => '80,000 BDT', 'note' => 'One Time'],
                        ['functionality' => 'Shipping Cart', 'frontend_price' => '20,000 BDT', 'backend_price' => '40,000 BDT', 'note' => 'One Time'],
                        ['functionality' => 'Checkout Page', 'frontend_price' => '20,000 BDT', 'backend_price' => '40,000 BDT', 'note' => 'One Time'],
                        ['functionality' => 'Payment Gateway Integration', 'frontend_price' => '', 'backend_price' => '10,000 BDT', 'note' => 'One Time'],
                        ['functionality' => 'User Management', 'frontend_price' => '20,000 BDT', 'backend_price' => '40,000 BDT', 'note' => 'One Time'],
                        ['functionality' => 'Order Management', 'frontend_price' => '20,000 BDT', 'backend_price' => '40,000 BDT', 'note' => 'One Time'],
                        ['functionality' => 'Inventory Management', 'frontend_price' => '30,000 BDT', 'backend_price' => '50,000 BDT', 'note' => 'One Time'],
                        ['functionality' => 'Discount & Coupon Management', 'frontend_price' => '', 'backend_price' => '40,000 BDT', 'note' => 'One Time'],
                        ['functionality' => 'Analytics & Reporting', 'frontend_price' => '50,000 BDT', 'backend_price' => '50,000 BDT', 'note' => 'One Time'],
                        ['functionality' => 'Customer Reviews & Ratings', 'frontend_price' => '20,000 BDT', 'backend_price' => '40,000 BDT', 'note' => 'One Time'],
                        ['functionality' => 'Wishlist / Favorites', 'frontend_price' => '10,000 BDT', 'backend_price' => '20,000 BDT', 'note' => 'One Time'],
                        ['functionality' => 'Role-based Access Control', 'frontend_price' => '30,000 BDT', 'backend_price' => '50,000 BDT', 'note' => 'One Time'],
                        ['functionality' => 'Return & Refund Management', 'frontend_price' => '20,000 BDT', 'backend_price' => '40,000 BDT', 'note' => 'One Time'],
                        ['functionality' => 'Search & Filter System', 'frontend_price' => '10,000 BDT', 'backend_price' => '20,000 BDT', 'note' => 'One Time'],
                        ['functionality' => 'Courier API Integration', 'frontend_price' => '', 'backend_price' => '20,000 BDT', 'note' => 'One Time'],
                        ['functionality' => 'Tax Management', 'frontend_price' => '', 'backend_price' => '40,000 BDT', 'note' => 'One Time'],
                        ['functionality' => 'Deployment', 'frontend_price' => '30,000 BDT', 'backend_price' => '30,000 BDT', 'note' => 'One Time'],
                    ],
                    'core_features_total_frontend' => '6,60,000 BDT',
                    'core_features_total_backend' => '7,70,000 BDT',
                    'total_development_cost' => '1,430,000 BDT',
                    'yearly_cost' => '868 USD',
                    'additional_modules' => [
                        ['functionality' => 'Email & SMS Notifications', 'frontend_price' => '', 'backend_price' => '20,000 BDT', 'note' => 'Order confirmations, promotions, alerts'],
                        ['functionality' => 'AI Recommendation System', 'frontend_price' => '', 'backend_price' => '3,00,000 BDT', 'note' => 'Personalized product suggestions, upselling'],
                        ['functionality' => 'Advanced Analytics Dashboard', 'frontend_price' => '', 'backend_price' => '60,000 BDT', 'note' => 'Real-time sales, customer behavior, inventory insights'],
                        ['functionality' => 'Chatbot / AI Customer Support', 'frontend_price' => '80,000 BDT', 'backend_price' => '1,20,000 BDT', 'note' => 'AI-driven real-time chat with FAQ integration'],
                        ['functionality' => 'Advanced Search & Filtering', 'frontend_price' => '30,000 BDT', 'backend_price' => '50,000 BDT', 'note' => 'AI-powered search with auto-suggestions'],
                        ['functionality' => 'Multi-Language & Multi-Currency', 'frontend_price' => '20,000 - 80,000 BDT', 'backend_price' => '30,000 - 1,20,000 BDT', 'note' => 'Supports global customers and localization'],
                        ['functionality' => 'Affiliate / Influencer System', 'frontend_price' => '1,00,000 BDT', 'backend_price' => '1,00,000 BDT', 'note' => 'Track referrals, commissions, influencer sales'],
                        ['functionality' => 'Loyalty & Rewards System', 'frontend_price' => '50,000 BDT', 'backend_price' => '50,000 BDT', 'note' => 'Points, cashback, and tiered rewards'],
                        ['functionality' => 'DevOps', 'frontend_price' => '2,00,000 BDT', 'backend_price' => '3,00,000 BDT', 'note' => 'CI/CD pipeline, automated deployment'],
                        ['functionality' => 'Meta Integration', 'frontend_price' => '', 'backend_price' => '1,00,000 BDT', 'note' => 'Facebook/Instagram shop integration'],
                        ['functionality' => 'CRM Integration', 'frontend_price' => '2,00,000 BDT', 'backend_price' => '3,00,000 BDT', 'note' => 'Customer relationship management system'],
                    ]
                ],
            ],
            [
                'title' => 'Support & Maintenance',
                'value' => [
                    'content' => '<p>The following service agreement outlines the support relationship between ZOOM IT and the Client:</p>',
                    'items' => [
                        'Support & Maintenance covers fixing all bugs and system errors',
                        'Includes updating website content, images, videos, and adding similar new webpages',
                        'Design tweaking and semi-customization during support period subject to additional charges',
                        'ZOOM IT provides all necessary support to keep the website running optimally',
                        'Website updates typically completed within 1 working day',
                        'Client does not need an IT department - ZOOM IT provides end-to-end solution',
                        'Support hours: Sunday-Thursday, 10 AM to 6 PM (excluding prayer times)',
                    ],
                    'highlight' => '<strong>Comprehensive Support Package Includes:</strong> Site monitoring, security updates, on-call web support, and free training with video tutorials.',
                ],
            ],
            [
                'title' => 'Terms & Conditions',
                'value' => [
                    'content' => '<p>The following terms and conditions govern the proposed system development:</p>',
                    'items' => [
                        'The proposed project shall remain 100% confidential and unpublished by ZOOM IT',
                        'Client shall be the sole proprietor of the website',
                        'Re-distribution of the website by Client requires contractual agreement',
                        'Client holds no rights to distribute designs, code, or database designs without agreement',
                        'ZOOM IT reserves the right to link back to our website for marketing purposes',
                    ],
                    'signature_area' => [
                        'I hereby agree and accept all the above Terms & Conditions of the proposed proposal, and understand that by indicating agreement and acceptance above, and signing and returning this document I am contracting ZOOM IT to undertake the work as described in this proposal.',
                        'Agreed and Authorized By',
                        'Name: ___________________________',
                        'Title: ___________________________',
                        'Date: ___________________________',
                        'Company: Mondol Group',
                    ]
                ],
            ],
        ]);
    }
}
