<div class="card">
        <div class="card-header">
            <a href="{{ isset($answer->user->customurl) ? $answer->user->customurl : $answer->user->id }}" class="card-title">
                <img src="{{ $answer->user->avatar }}" alt="avatar" class="rounded card-subtitle" style="max-width:2rem;max-height: 2rem;">
                {{ $answer->user->name }}
            </a> said
        </div>
    <div class="card-body">
        <div class="card-text">
                <span class=" float-right">{{ $answer->created_at->diffForHumans() }}</span>
        {{ $answer->body }}
        </div>
    </div>
</div>

<br>