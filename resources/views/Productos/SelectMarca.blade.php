<div class="input-group{{ $errors->has('Proveedor') ? ' has-danger' : '' }}">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                <i class="fas fa-truck"></i>
                                </div>
                            </div>                                   
                            <select   name="IdMarcaT" id="IdMarcaAC" class="form-control{{ $errors->has('Marca') ? ' is-invalid' : '' }}" placeholder="{{ __('IdMarca') }}">
                                <option class="bg-dark">Elige una Marca</option>
                                @foreach($DetalleMarca as $Mar)
                                <option class="bg-dark" value="{{$Mar->IdMarca}}">{{$Mar->Descripcion}}</option>
                                @endforeach
                                
                            </select>
                            @include('alerts.feedback', ['field' => 'IdMarca'])
                        </div>