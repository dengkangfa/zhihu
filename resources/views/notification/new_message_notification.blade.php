<li class="notifications {{ $notification->unread() ? 'unread' : ' ' }}">
    <a href="{{$notification->unread() ? '/notifications/'.$notification->id.'?redirect_url=/inbox/'.$notification->data['dialog_id'] : '/inbox/'.$notification->data['dialog_id']}}">
        {{ $notification->data['name'] }} 给你发了一条私信
    </a>
</li>