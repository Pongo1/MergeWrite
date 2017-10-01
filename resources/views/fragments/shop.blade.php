@forelse ($shopItems as $Rank)
    <div class="thumbnail thumbnail-tune solid-rank clearfix" style='max-height:350px; overflow-y:scroll; {{ Auth::user()->rank->rank == $Rank->rank ? 'border: solid 3px cyan' : ''}}'>
        <div class="{{'cover-piece-text solid-rank '.$Rank->rank}}" style='{{$Rank->rank =='Siphiwe' ? 'border-color:white;' : 'border-color:black;'}}'>
            <h2>{{$Rank->rank}}</h2>
        </div>

        <p class='dark-knight '>{{$Rank->rank_description}}</p>
        <small class='dark-knight'>With this rank, your likes will be worth {{$Rank->rank_worth/2}} coins.</small>
        @if(Auth::user()->rank->number < $Rank->id)
            <button class='btn btn-primary pull-right solid-rank' data-toggle='tooltip' data-placement='top' title='You have passed {{$Rank->rank}}'><span class='glyphicon glyphicon-ok'></span></button>
        @elseif (Auth::user()->rank->number == $Rank->id)
            <button class='btn btn-success pull-right solid-rank {{$Rank->rank}}' data-toggle='tooltip' data-placement='top' title='You are a {{$Rank->rank}}'>Aquired</button>
        @else
            @if(Auth::user()->bank->coins >= $Rank->rank_cost)
                <button class='btn btn-success solid-rank pull-right rank-buy' data-toggle='tooltip' data-placement='top' title='Aquire this rank'>{{$Rank->rank_cost}}</button>
            @else
                <button class='btn btn-default pull-right solid-rank not-buy' data-toggle='tooltip' data-placement='top' title='You cannot advance to {{$Rank->rank}}.  You do not have enough coins, keep writing'>{{$Rank->rank_cost}}</button>
            @endif
       @endif
    </div>
@empty

@endforelse
