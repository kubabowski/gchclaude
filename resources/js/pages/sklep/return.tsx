import { Head, Link } from '@inertiajs/react';
import AppLayout from '@/layouts/app-layout';
import { Button } from '@/components/ui/button';
import type { BreadcrumbItem } from '@/types';

const breadcrumbs: BreadcrumbItem[] = [
    { title: 'Sklep', href: '/sklep' },
    { title: 'Potwierdzenie', href: '/sklep/return' },
];

export default function SklepReturn({
                                        success,
                                        sessionId,
                                    }: {
    success: boolean;
    sessionId?: string;
}) {
    return (
        <AppLayout breadcrumbs={breadcrumbs}>
            <Head title={success ? 'Dziękujemy za zakup!' : 'Błąd płatności'} />

            <div className="return-wrapper">
                <div className={`return-card ${success ? 'return-success' : 'return-error'}`}>
                    <div className="return-icon">{success ? '✅' : '❌'}</div>

                    <h1 className="return-title">
                        {success ? 'Dziękujemy za zakup!' : 'Coś poszło nie tak'}
                    </h1>

                    <p className="return-message">
                        {success
                            ? 'Twoja płatność została zarejestrowana. Potwierdzenie zostanie wysłane na podany adres e-mail.'
                            : 'Płatność nie została zrealizowana. Spróbuj ponownie lub skontaktuj się z obsługą.'}
                    </p>

                    {sessionId && (
                        <p className="return-session">
                            Numer zamówienia: <strong>{sessionId}</strong>
                        </p>
                    )}

                    <div className="return-actions">
                        <Button asChild className="return-btn">
                            <Link href="/sklep">Wróć do sklepu</Link>
                        </Button>
                    </div>
                </div>
            </div>

            <style>{`
                .return-wrapper {
                    max-width: 520px;
                    margin: 4rem auto;
                    padding: 0 1.5rem;
                }

                .return-card {
                    background: var(--card);
                    border: 1px solid var(--border);
                    border-radius: 1.25rem;
                    padding: 3rem 2rem;
                    text-align: center;
                    box-shadow: 0 4px 32px rgba(0,0,0,.08);
                }

                .return-success {
                    border-top: 4px solid #22c55e;
                }

                .return-error {
                    border-top: 4px solid #ef4444;
                }

                .return-icon {
                    font-size: 3.5rem;
                    margin-bottom: 1.25rem;
                }

                .return-title {
                    font-size: 1.6rem;
                    font-weight: 700;
                    color: var(--foreground);
                    margin-bottom: 0.75rem;
                }

                .return-message {
                    color: var(--muted-foreground);
                    line-height: 1.65;
                    margin-bottom: 1rem;
                }

                .return-session {
                    font-size: 0.85rem;
                    color: var(--muted-foreground);
                    margin-bottom: 2rem;
                    background: var(--muted);
                    padding: 0.5rem 1rem;
                    border-radius: 0.5rem;
                    display: inline-block;
                }

                .return-actions {
                    margin-top: 2rem;
                }

                .return-btn {
                    background: linear-gradient(135deg, #6366f1, #8b5cf6);
                    color: white;
                    padding: 0.7rem 2rem;
                    border-radius: 0.6rem;
                    font-weight: 600;
                }
            `}</style>
        </AppLayout>
    );
}
