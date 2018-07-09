@extends('_layouts.app')
@section('title', 'History Log')
@section('style')
    <link rel="stylesheet" href="{{ asset('dist/datatables/datatables.bundle.css') }}">
@endsection
@section('content')

    @component('_components.app')
        @slot('head')
            @component('_components.caption')
              @slot('title') Data @yield('title')  @endslot
              @if(RolePerms::isExport('pengaturan'))
                  @slot('clear')  @endslot
              @endif
              @if(RolePerms::isCreate('pengaturan'))
                  @slot('create') {{ route('menu.create') }} @endslot
              @endif
            @endcomponent
        @endslot
        @slot('body')
            @component('_components.table')
                @slot('thead')
                    <tr>
                        <th width="5%">#</th>
                        <th width="10%">Model</th>
                        <th width="20%">Event</th>
                        <th width="20%">User</th>
                        <th width="20%">Modul</th>
                        <th width="20%">Logs</th>
                    </tr>
                @endslot
                @slot('tbody')
                    @foreach ($logs as $key => $value)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $value->model }}</td>
                            <td>
                                {{ $value->event }}
                                <div class="load-more-tickets">
                                      <a href="#"
                                         data-target="#modal-{{ $value->id }}"
                                         data-toggle="modal">
                                         <span>Lihat Detail..</span>
                                     </a>
                                     @include('settings.logs.log')
                                </div>
                            </td>
                            <td>{{ Select::pegawai($value->user_id)->nama_pegawai }} - {{ RolePerms::roleUser($value->user_id)->label }}</td>
                            <td class="text-center">
                                @if($value->modul_type == 'modul')
                                    Modul {{ Select::modul($value->modul_id)->label }}
                                @elseif($value->modul_type == 'menu')
                                    Menu {{ Select::menu($value->modul_id)->label }}
                                @else
                                    Submenu {{ Select::submenu($value->modul_id)->label }}
                                @endif
                            </td>
                            <td class="text-center">{{ \Carbon\Carbon::parse($value->created_at)->format('d M Y - h:i:s') }}</td>
                        </tr>
                    @endforeach
                @endslot
                @slot('tfoot') @endslot
            @endcomponent

        @endslot
    @endcomponent

@stop

@section('script')
    <script type="text/javascript" src="{{ asset('dist/datatables/datatables.bundle.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#dataTable').DataTable({
                "lengthMenu": [ [10, 25, 50, -1], [10, 25, 50, "All"] ]
            });
            $(document).find('[data-toggle="confirmation"]').confirmation();
        });
    </script>
@stop
