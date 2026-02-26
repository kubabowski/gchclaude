import { Head, useForm } from '@inertiajs/react';
import { useState } from 'react';
import AppLayout from '@/layouts/app-layout';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import type { BreadcrumbItem } from '@/types';

const breadcrumbs: BreadcrumbItem[] = [
    { title: 'Sklep', href: '/sklep' },
];

interface Product {
    id: number;
    name: string;
    description: string;
    price: number; // in grosze
    image: string;
}

export default function SklepIndex({ product }: { product: Product }) {
    const [quantity, setQuantity] = useState(1);

    const { data, setData, post, processing, errors } = useForm({
        quantity: 1,
        email: '',
        name: '',
    });

    const unitPrice = product.price / 100;
    const total = unitPrice * quantity;

    const handleQuantityChange = (val: number) => {
        const clamped = Math.max(1, Math.min(99, val));
        setQuantity(clamped);
        setData('quantity', clamped);
    };

    const handleSubmit = (e: React.FormEvent) => {
        e.preventDefault();
        post('/sklep/checkout');
    };

    return (
        <AppLayout breadcrumbs={breadcrumbs}>
            <Head title="Sklep" />

            <div className="sklep-wrapper">
                <div className="sklep-header">
                    <h1 className="sklep-title">Sklep</h1>
                    <p className="sklep-subtitle">Wybierz produkt i przejdź do płatności</p>
                </div>

                <div className="sklep-content">
                    {/* Product Card */}
                    <div className="product-card">
                        <div className="product-image-wrapper">
                            <div className="product-image-placeholder">
                                <span className="product-icon">🎓</span>
                            </div>
                        </div>

                        <div className="product-info">
                            <span className="product-badge">Bestseller</span>
                            <h2 className="product-name">{product.name}</h2>
                            <p className="product-description">{product.description}</p>

                            <div className="product-features">
                                <div className="feature-item">✅ Dostęp dożywotni</div>
                                <div className="feature-item">✅ Certyfikat ukończenia</div>
                                <div className="feature-item">✅ Wsparcie mentora</div>
                                <div className="feature-item">✅ Aktualizacje gratis</div>
                            </div>

                            <div className="product-price">
                                <span className="price-amount">{unitPrice.toFixed(2)} PLN</span>
                                <span className="price-label">/ sztuka</span>
                            </div>
                        </div>
                    </div>

                    {/* Checkout Form */}
                    <div className="checkout-card">
                        <h3 className="checkout-title">Zamów teraz</h3>

                        <form onSubmit={handleSubmit} className="checkout-form">
                            {/* Quantity */}
                            <div className="form-group">
                                <Label htmlFor="quantity" className="form-label">
                                    Ilość
                                </Label>
                                <div className="quantity-control">
                                    <button
                                        type="button"
                                        className="qty-btn"
                                        onClick={() => handleQuantityChange(quantity - 1)}
                                        disabled={quantity <= 1}
                                    >
                                        −
                                    </button>
                                    <input
                                        id="quantity"
                                        type="number"
                                        min={1}
                                        max={99}
                                        value={quantity}
                                        onChange={(e) => handleQuantityChange(Number(e.target.value))}
                                        className="qty-input"
                                    />
                                    <button
                                        type="button"
                                        className="qty-btn"
                                        onClick={() => handleQuantityChange(quantity + 1)}
                                        disabled={quantity >= 99}
                                    >
                                        +
                                    </button>
                                </div>
                            </div>

                            {/* Name */}
                            <div className="form-group">
                                <Label htmlFor="name" className="form-label">
                                    Imię i nazwisko
                                </Label>
                                <Input
                                    id="name"
                                    type="text"
                                    value={data.name}
                                    onChange={(e) => setData('name', e.target.value)}
                                    placeholder="Jan Kowalski"
                                    className="form-input"
                                    required
                                />
                                {errors.name && <p className="form-error">{errors.name}</p>}
                            </div>

                            {/* Email */}
                            <div className="form-group">
                                <Label htmlFor="email" className="form-label">
                                    Adres e-mail
                                </Label>
                                <Input
                                    id="email"
                                    type="email"
                                    value={data.email}
                                    onChange={(e) => setData('email', e.target.value)}
                                    placeholder="jan@example.com"
                                    className="form-input"
                                    required
                                />
                                {errors.email && <p className="form-error">{errors.email}</p>}
                            </div>

                            {errors.payment && (
                                <div className="payment-error">{errors.payment}</div>
                            )}

                            {/* Summary */}
                            <div className="order-summary">
                                <div className="summary-row">
                                    <span>Cena jednostkowa</span>
                                    <span>{unitPrice.toFixed(2)} PLN</span>
                                </div>
                                <div className="summary-row">
                                    <span>Ilość</span>
                                    <span>× {quantity}</span>
                                </div>
                                <div className="summary-divider" />
                                <div className="summary-row summary-total">
                                    <span>Łącznie</span>
                                    <span>{total.toFixed(2)} PLN</span>
                                </div>
                            </div>

                            <Button
                                type="submit"
                                disabled={processing}
                                className="checkout-btn"
                            >
                                {processing ? (
                                    <span className="btn-loading">
                                        <span className="spinner" />
                                        Przekierowuję…
                                    </span>
                                ) : (
                                    <>
                                        <span>Zapłać przez Przelewy24</span>
                                        <span className="btn-icon">→</span>
                                    </>
                                )}
                            </Button>

                            <p className="checkout-note">
                                🔒 Płatność obsługiwana przez Przelewy24. Twoje dane są bezpieczne.
                            </p>
                        </form>
                    </div>
                </div>
            </div>

            <style>{`
                .sklep-wrapper {
                    max-width: 1100px;
                    margin: 0 auto;
                    padding: 2rem 1.5rem 4rem;
                }

                .sklep-header {
                    text-align: center;
                    margin-bottom: 2.5rem;
                }

                .sklep-title {
                    font-size: 2.25rem;
                    font-weight: 700;
                    color: var(--foreground);
                    margin-bottom: 0.5rem;
                }

                .sklep-subtitle {
                    color: var(--muted-foreground);
                    font-size: 1.05rem;
                }

                .sklep-content {
                    display: grid;
                    grid-template-columns: 1fr;
                    gap: 2rem;
                }

                @media (min-width: 900px) {
                    .sklep-content {
                        grid-template-columns: 1.4fr 1fr;
                        align-items: start;
                    }
                }

                /* Product Card */
                .product-card {
                    background: var(--card);
                    border: 1px solid var(--border);
                    border-radius: 1rem;
                    overflow: hidden;
                    box-shadow: 0 4px 24px rgba(0,0,0,.06);
                }

                .product-image-wrapper {
                    background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%);
                    padding: 3rem 2rem;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                }

                .product-image-placeholder {
                    width: 100px;
                    height: 100px;
                    background: rgba(255,255,255,0.15);
                    border-radius: 50%;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    backdrop-filter: blur(4px);
                }

                .product-icon {
                    font-size: 3rem;
                }

                .product-info {
                    padding: 1.75rem;
                }

                .product-badge {
                    display: inline-block;
                    background: #fef3c7;
                    color: #92400e;
                    font-size: 0.72rem;
                    font-weight: 600;
                    padding: 0.2rem 0.65rem;
                    border-radius: 999px;
                    text-transform: uppercase;
                    letter-spacing: 0.05em;
                    margin-bottom: 0.75rem;
                }

                .dark .product-badge {
                    background: #451a03;
                    color: #fcd34d;
                }

                .product-name {
                    font-size: 1.4rem;
                    font-weight: 700;
                    color: var(--foreground);
                    margin-bottom: 0.75rem;
                    line-height: 1.3;
                }

                .product-description {
                    color: var(--muted-foreground);
                    font-size: 0.95rem;
                    line-height: 1.6;
                    margin-bottom: 1.25rem;
                }

                .product-features {
                    display: grid;
                    grid-template-columns: 1fr 1fr;
                    gap: 0.4rem;
                    margin-bottom: 1.5rem;
                }

                .feature-item {
                    font-size: 0.875rem;
                    color: var(--foreground);
                }

                .product-price {
                    display: flex;
                    align-items: baseline;
                    gap: 0.4rem;
                    padding-top: 1rem;
                    border-top: 1px solid var(--border);
                }

                .price-amount {
                    font-size: 2rem;
                    font-weight: 700;
                    color: #6366f1;
                }

                .price-label {
                    color: var(--muted-foreground);
                    font-size: 0.9rem;
                }

                /* Checkout Card */
                .checkout-card {
                    background: var(--card);
                    border: 1px solid var(--border);
                    border-radius: 1rem;
                    padding: 1.75rem;
                    box-shadow: 0 4px 24px rgba(0,0,0,.06);
                    position: sticky;
                    top: 1rem;
                }

                .checkout-title {
                    font-size: 1.2rem;
                    font-weight: 700;
                    color: var(--foreground);
                    margin-bottom: 1.5rem;
                }

                .checkout-form {
                    display: flex;
                    flex-direction: column;
                    gap: 1.1rem;
                }

                .form-group {
                    display: flex;
                    flex-direction: column;
                    gap: 0.4rem;
                }

                .form-label {
                    font-size: 0.875rem;
                    font-weight: 500;
                    color: var(--foreground);
                }

                .form-input {
                    width: 100%;
                }

                .form-error {
                    color: #ef4444;
                    font-size: 0.8rem;
                    margin-top: 0.2rem;
                }

                /* Quantity control */
                .quantity-control {
                    display: flex;
                    align-items: center;
                    gap: 0;
                    border: 1px solid var(--border);
                    border-radius: 0.5rem;
                    overflow: hidden;
                    width: fit-content;
                }

                .qty-btn {
                    width: 2.5rem;
                    height: 2.5rem;
                    background: var(--muted);
                    border: none;
                    font-size: 1.2rem;
                    font-weight: 600;
                    cursor: pointer;
                    color: var(--foreground);
                    transition: background 0.15s;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                }

                .qty-btn:hover:not(:disabled) {
                    background: var(--accent);
                }

                .qty-btn:disabled {
                    opacity: 0.4;
                    cursor: not-allowed;
                }

                .qty-input {
                    width: 3.5rem;
                    height: 2.5rem;
                    text-align: center;
                    border: none;
                    border-left: 1px solid var(--border);
                    border-right: 1px solid var(--border);
                    font-size: 1rem;
                    font-weight: 600;
                    background: var(--background);
                    color: var(--foreground);
                    -moz-appearance: textfield;
                }

                .qty-input::-webkit-outer-spin-button,
                .qty-input::-webkit-inner-spin-button {
                    -webkit-appearance: none;
                }

                /* Order summary */
                .order-summary {
                    background: var(--muted);
                    border-radius: 0.75rem;
                    padding: 1rem 1.1rem;
                    display: flex;
                    flex-direction: column;
                    gap: 0.5rem;
                }

                .summary-row {
                    display: flex;
                    justify-content: space-between;
                    font-size: 0.9rem;
                    color: var(--muted-foreground);
                }

                .summary-divider {
                    height: 1px;
                    background: var(--border);
                    margin: 0.25rem 0;
                }

                .summary-total {
                    font-size: 1.05rem;
                    font-weight: 700;
                    color: var(--foreground);
                }

                .payment-error {
                    background: #fef2f2;
                    border: 1px solid #fecaca;
                    color: #b91c1c;
                    border-radius: 0.5rem;
                    padding: 0.75rem 1rem;
                    font-size: 0.875rem;
                }

                .dark .payment-error {
                    background: #450a0a;
                    border-color: #7f1d1d;
                    color: #fca5a5;
                }

                /* Checkout button */
                .checkout-btn {
                    width: 100%;
                    padding: 0.8rem;
                    font-size: 1rem;
                    font-weight: 600;
                    background: linear-gradient(135deg, #6366f1, #8b5cf6);
                    color: white;
                    border: none;
                    border-radius: 0.6rem;
                    cursor: pointer;
                    transition: opacity 0.2s, transform 0.1s;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    gap: 0.5rem;
                }

                .checkout-btn:hover:not(:disabled) {
                    opacity: 0.92;
                    transform: translateY(-1px);
                }

                .checkout-btn:disabled {
                    opacity: 0.6;
                    cursor: not-allowed;
                }

                .btn-icon {
                    font-size: 1.1rem;
                }

                .btn-loading {
                    display: flex;
                    align-items: center;
                    gap: 0.6rem;
                }

                .spinner {
                    width: 16px;
                    height: 16px;
                    border: 2px solid rgba(255,255,255,0.3);
                    border-top-color: white;
                    border-radius: 50%;
                    animation: spin 0.7s linear infinite;
                    flex-shrink: 0;
                }

                @keyframes spin {
                    to { transform: rotate(360deg); }
                }

                .checkout-note {
                    font-size: 0.78rem;
                    color: var(--muted-foreground);
                    text-align: center;
                    line-height: 1.5;
                }
            `}</style>
        </AppLayout>
    );
}
