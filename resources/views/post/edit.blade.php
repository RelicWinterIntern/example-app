<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('投稿編集') }}
        </h2>
    </x-slot>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body mt-4">
                        <form method="POST" action="{{ route('post.update', $post->id) }}">
                            @csrf
                            @method('PATCH')

                            <div class="form-group row">
                                <label for="title" class="col-md-4 col-form-label text-md-right">{{ __('タイトル') }}</label>

                                <div class="col-md-6">
                                    <input id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ old('title', $post->title) }}" required autocomplete="title" autofocus>

                                    @error('title')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row my-4">
                                <label for="body" class="col-md-4 col-form-label text-md-right">{{ __('本文') }}</label>

                                <div class="col-md-6">
                                    <textarea id="body" class="form-control @error('body') is-invalid @enderror" name="body" required>{{ old('body', $post->body) }}</textarea>

                                    @error('body')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="topic_tag" class="col-md-4 col-form-label text-md-right">{{ __('タグ') }}</label>
                                <div class="col-md-6">
                                    <select name="topic_tag" id="topic_tag" class="form-control @error('topic_tag') is-invalid @enderror" required>
                                        <option value="フリー" {{$post->topic_tag == 'フリー' ? "selected" : ''}}>フリー</option>
                                        <option value="スポーツ" {{$post->topic_tag == 'スポーツ' ? "selected" : ''}}>スポーツ</option>
                                        <option value="アニメ" {{$post->topic_tag == 'アニメ' ? "selected" : ''}}>アニメ</option>
                                        <option value="ゲーム" {{$post->topic_tag == 'ゲーム' ? "selected" : ''}}>ゲーム</option>
                                        <option value="鑑賞" {{$post->topic_tag == '鑑賞' ? "selected" : ''}}>鑑賞</option>
                                    </select>
                                    @error('topic_tag')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('変更を保存する') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
