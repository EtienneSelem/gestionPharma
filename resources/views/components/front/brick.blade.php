@props(['post'])

<a href="{{ route('posts.display', $post->slug) }}">
    <div class="slide"> 
        <div class="user">
            <img src="{{ getImage($post, true) }}" alt="">
            <div class="user-info col-lg-9" style="min-height:50px;">
                <h4><span><i class="fa fa-mail-forward"></i>
                    </span> <strong> {{ $post->user->name }}</strong> 
                    <span class="date"> {{formatDate($post->created_at)}}</span> 
                    <span class="date">
                        @foreach ($post->categories as $category)
                            <p>{{ $category->title }}</p>     
                        @endforeach
                    </span> 
                </h4>
                <h3 style="font-size: 20px;font-weight:600">{{ $post->title }}</h3>
                <p style="text-align: justify;">{!! substr($post->excerpt, 0, 130) !!}</p>
            </div>
        </div>
    </div>
</a>


