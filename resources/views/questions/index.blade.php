@extends('layout.base')

@section('title', 'Preguntas')
@section('sectionTitle', 'Preguntas')

@section('content')
    @if ($questions->isEmpty())
        <div class="empty">
            <div class="empty-icon">
                <i class="typcn typcn-tags"></i>
            </div><!-- /.empty-icon -->
            @if (Auth::user()->role == 'seller')
                <h4 class="empty-title">Aún no te han hecho preguntas</h4><!-- /.empty-title -->
            @elseif(Auth::user()->role == 'customer')
                <h4 class="empty-title">Aún no haz hecho preguntas</h4><!-- /.empty-title -->
            @endif
        </div>
        <!-- /.empty -->
    @else
        <div class="panel">
            <table class="table table-striped table-hover datatable">
                <thead>
                    <tr>
                        @if (Auth::user()->role == 'seller')
                            <th>Nombre</th>
                        @endif
                        <th>Producto</th>
                        <th>Pregunta</th>
                        <th>Estado</th>
                        @if (Auth::user()->role == 'seller')
                            <th>Opciones</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @foreach ($questions as $question)
                        <tr>
                            @if (Auth::user()->role == 'seller')
                                <td>{{ $question->user->profile->firstname }}</td>
                            @endif
                            <td><a href="{{ url('producto', $question->product->slug) }}" class="link" target="_blank">{{ $question->product->title }}</a></td>
                            <td>
                                {{ $question->content }}
                                @unless (is_null($question->answer))
                                    <br>
                                    <i><b>R:</b> {{ $question->answer->content }}</i>
                                @endunless
                            </td>
                            <td>
                                @if ($question->answer)
                                    <span class="label label-success">Respondida</span>
                                @else
                                    <span class="label label-warning">Pendiente</span>
                                @endif
                            </td>
                            @if (Auth::user()->role == 'seller')
                                <td>
                                    @unless ($question->answer)
                                        <button class="trigger-modal btn btn-primary" data-modal="answer-modal" data-action="{{ url('admin/questions/answer', $question->id) }}" data-text="{{ $question->content }}">Responder</button>
                                    @endunless
                                </td>
                            @endif
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <!-- /.table table-striped table-hover -->
        </div>
        <!-- /.panel -->
    @endif
@endsection

@section('modal')
    <div class="modal" id="answer-modal">
        <div class="modal-overlay"></div>
        <!-- /.modal-overlay -->
        <div class="modal-container">
            <div class="modal-header">
                <button class="close-modal btn btn-clear float-right"></button>
                <div class="modal-title">Responder pregunta</div>
                <!-- /.modal-title -->
                <div class="modal-body">
                    <div class="content">
                        <p class="text"></p>
                        {{ Form::open(['url' => url('/')]) }}
                            <div class="form-group">
                                {{ Form::label('content', 'Respuesta', ['class' => 'form-label']) }}
                                {{ Form::textarea('content', null, ['size' => '50x3', 'class' => 'form-input autosizable']) }}
                            </div>
                            <!-- /.form-group -->
                            <div class="form-group">
                                {{ Form::submit('Enviar respuesta', ['class' => 'btn btn-primary']) }}
                            </div>
                            <!-- /.form-group -->
                        {{ Form::close() }}
                    </div>
                    <!-- /.content -->
                </div>
                <!-- /.modal-body -->
            </div>
            <!-- /.modal-header -->
        </div>
        <!-- /.modal-container -->
    </div>
    <!-- /.modal active -->
@endsection
