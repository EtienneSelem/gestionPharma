@props(['comment'])

<section class="comment" id="comment">

    <div class=" comment-slide">
        <div class="wrapper">
            <div class="comment-slide">
                <div class="chat user">
                    <img src="{{ $comment->user->profile_photo_path === NULL ? Gravatar::get($comment->user->email) : asset('storage')}}/{{$comment->user->profile_photo_path}}  " alt="">
                    
                    <div class="user-info">
                        <h3>
                            {{ $comment->user->name }}<span>  {{ formatDate($comment->created_at) }} @lang('à') {{ formatHour($comment->created_at) }} </span>
                            @if(Auth::guest())
                            
                                <a href="{{route('login')}} ">@lang('connectez vous pour repondre')</a>
                            @endif
                        </h3>
                            
                        <p style=" text-align: justify;">
                            {{ $comment->body }} 
                        </p>
                        
                        <span>
                            @if(Auth::check())
                            @if($comment->depth < config('app.commentsNestedLevel'))
                            <strong >
                                <a style="color: blue"
                                        class="comment-reply-link replycomment" 
                                        href="#" 
                                        data-name="{{ $comment->user->name }}" 
                                        data-id="{{ $comment->id }}">
                                        @lang('Reply')
                                    </a>
                            </strong>
                                    
                                @endif
                                @if(Auth::user()->name == $comment->user->name)
                                    <a 
                                        href="{{ route('front.comments.destroy', $comment->id) }}" 
                                        class="comment-reply-link deletecomment" 
                                        style="color:red">
                                        @lang('Delete')
                                    </a>
                                @endif 
                            @endif
                         </span>
                    </div>
                </div> <hr> 
                <div class="children repondre">
                    <x-front.comments :comments="$comment->children"/>
                </div>
            </div>
        </div>
    </div>
</section>