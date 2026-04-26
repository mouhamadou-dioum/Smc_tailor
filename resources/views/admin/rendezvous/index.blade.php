@extends('layouts.master')

@section('title', 'Admin - Rendez-vous')

@section('content')
<div class="py-4">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>Gestion des Rendez-vous</h2>
            <span class="badge bg-secondary fs-6">
                {{ $rendezVous->where('statut', 'EN_ATTENTE')->count() }} en attente
            </span>
        </div>

        @if(session('success'))
            <div class="alert alert-custom alert-success-custom mb-4">
                <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
            </div>
        @endif

        <div class="card-custom">
            <div class="table-responsive">
                <table class="table table-hover mb-0 align-middle">
                    <thead style="background-color: var(--gray-100);">
                        <tr>
                            <th>Client</th>
                            <th>Vêtement</th>
                            <th>Date & Heure</th>
                            <th>Statut RDV</th>
                            <th title="Dernier WhatsApp envoyé au client">
                                <i class="fab fa-whatsapp text-success"></i> WA Client
                            </th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($rendezVous as $rdv)
                        @php
                            $lastWa = $rdv->notifications
                                ->where('type', 'WHATSAPP')
                                ->sortByDesc('dateEnvoi')
                                ->first();

                            $rawPhone = $rdv->client->telephone ?? '';
                            $phone = preg_replace('/\D/', '', $rawPhone);
                            if ($phone && !str_starts_with($phone, '221')) {
                                $phone = '221' . ltrim($phone, '0');
                            }
                            $waText = urlencode(
                                "Bonjour {$rdv->client->prenom}, je vous contacte concernant votre rendez-vous du {$rdv->dateRendezVous->format('d/m/Y')} à {$rdv->heure}."
                            );
                        @endphp
                        <tr>
                            <td>
                                <strong>{{ $rdv->client->prenom }} {{ $rdv->client->nom }}</strong><br>
                                <small class="text-muted">
                                    <i class="fas fa-phone fa-xs me-1"></i>{{ $rdv->client->telephone ?? 'N/A' }}
                                </small>
                            </td>
                            <td>
                                @if($rdv->vetement)
                                    {{ $rdv->vetement->nom }}
                                @else
                                    <span class="text-muted fst-italic">À définir</span>
                                @endif
                            </td>
                            <td>
                                <strong>{{ $rdv->dateRendezVous->format('d/m/Y') }}</strong><br>
                                <small class="text-muted">{{ $rdv->heure }}</small>
                            </td>
                            <td>
                                @if($rdv->statut === 'EN_ATTENTE')
                                    <span class="badge badge-waiting">⏳ En attente</span>
                                @elseif($rdv->statut === 'CONFIRME')
                                    <span class="badge badge-confirmed">✅ Confirmé</span>
                                @else
                                    <span class="badge badge-rejected">❌ Refusé</span>
                                @endif
                            </td>

                            {{-- Statut du dernier WhatsApp envoyé au client --}}
                            <td>
                                @if($lastWa)
                                    @if($lastWa->statut === 'ENVOYE')
                                        <span class="badge bg-success" title="{{ $lastWa->dateEnvoi->format('d/m/Y H:i') }}">
                                            <i class="fab fa-whatsapp me-1"></i>Envoyé
                                        </span>
                                        <br><small class="text-muted">{{ $lastWa->dateEnvoi->diffForHumans() }}</small>
                                    @else
                                        <span class="badge bg-danger" title="Échec d'envoi">
                                            <i class="fas fa-exclamation-triangle me-1"></i>Échec
                                        </span>
                                        <br><small class="text-muted">{{ $lastWa->dateEnvoi->diffForHumans() }}</small>
                                    @endif
                                @else
                                    <span class="text-muted small">—</span>
                                @endif
                            </td>

                            <td>
                                <div class="d-flex gap-2 flex-wrap">
                                    @if($phone)
                                        <a href="https://wa.me/{{ $phone }}?text={{ $waText }}"
                                           target="_blank"
                                           class="btn btn-sm btn-success"
                                           title="Contacter sur WhatsApp">
                                            <i class="fab fa-whatsapp"></i>
                                        </a>
                                    @endif

                                    <a href="{{ route('admin.rendezvous.show', $rdv->id) }}"
                                       class="btn btn-sm btn-outline-primary"
                                       title="Voir détails">
                                        <i class="fas fa-eye"></i>
                                    </a>

                                    @if($rdv->statut === 'EN_ATTENTE')
                                        <a href="{{ route('admin.rendezvous.confirmer', $rdv->id) }}"
                                           class="btn btn-sm btn-success"
                                           title="Confirmer — envoie un WhatsApp au client"
                                           onclick="return confirm('Confirmer ce RDV ? Un WhatsApp de confirmation sera envoyé au client.')">
                                            <i class="fas fa-check"></i>
                                        </a>
                                        <a href="{{ route('admin.rendezvous.refuser', $rdv->id) }}"
                                           class="btn btn-sm btn-danger"
                                           title="Refuser — envoie un WhatsApp au client"
                                           onclick="return confirm('Refuser ce RDV ? Un WhatsApp sera envoyé au client.')">
                                            <i class="fas fa-times"></i>
                                        </a>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center py-4 text-muted">
                                Aucun rendez-vous pour le moment.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection