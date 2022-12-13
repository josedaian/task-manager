
@if(Session::has('alert'))
    @php  
    $flashAlert = Session::get('alert')
    @endphp

    <div id="flashMessage" class="alert alert-{{$flashAlert['type']==='error'?'danger':'success'}} alert-styled-left alert-dismissable m-2">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <i class="fa {{ $flashAlert['type'] === 'error' ? 'fa-exclamation-triangle': 'fa-check-circle' }} mr-1"></i> 
        {{ $flashAlert['text'] }}
    </div>

    @if(!empty($flashAlert['autoDismiss']))
        @push('scripts')
            <script>
                $(function(){
                    var dismiss = "{{ $flashAlert['autoDismiss'] }}";
                    window.setTimeout(function(){
                        $("#flashMessage").slideUp()
                    },dismiss*1000)
                });
            </script>
            
        @endpush
    @endif
@endif
