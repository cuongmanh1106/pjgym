@if (count($errors) > 0)
                <ul>
                  @foreach($errors->all() as $err)
                    <li style="color: red">{{ $err }}</li>
                  @endforeach
                </ul>
                @endif