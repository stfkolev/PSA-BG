<div class="panel panel-default">
        <div class="panel-heading">
            <a href="#">
                {{ $answer->user->name }}
            </a> said {{ $answer->created_at->diffForHumans() }}...
        </div>
    
        <div class="panel-body">
            {{ $answer->body }}
        </div>
    </div>