@extends('layout.template')
@section('title', 'Reservas de Guarderia - DogTRavel')
@section('content')

        <!-- Page Header End -->
        <div class="container-xxl py-5 page-header position-relative mb-5">
            <div class="container py-5">
                <h1 class="display-2 text-white animated slideInDown mb-4">{{$dataguarderia->nombre}}</h1>

            </div>
        </div>
        <!-- Page Header End -->


        <!-- Contact Start -->
        <div class="container-xxl py-5">
            <div class="container">
                <div class="row">

                 <div class="col-md-6 col-lg-6 wow fadeIn bg-light " data-wow-delay="0.1s">
                            <div class="h-100 d-flex flex-column justify-content-center p-5">

                                <h1 class="mb-3">Completa tu reserva</h1>

                                <p class="mb-4" style="text-align: justify" >{{$dataguarderia->observaciones}} </p>
                                <form id="createReserva">
                                    {{ csrf_field() }}
                                    <div class="row g-3">
                                        <div class="col-sm-6">
                                            <div class="form-floating">
                                                <input type="date" class="form-control border-0" id="name" name="fechainicio" placeholder="Your Name">
                                                <label for="name">Fecha Entrada</label>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-floating">
                                                <input type="number" class="form-control border-0" name="dias" id="dias" placeholder="Dias de hospedaje">
                                                <label for="email">Dias</label>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-floating">
                                                <input type="text" class="form-control border-0" value="Kira" id="mascota" name="mascota" placeholder="Subject">
                                                <label for="subject">Nombre de mascota</label>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-floating">
                                                <textarea class="form-control border-0" placeholder="Leave a message here" id="message" name="message" style="height: 100px"></textarea>
                                                <label for="message">Mensaje extra</label>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <button class="btn btn-primary w-100 py-3" type="button" onclick="reservacrear({{$dataguarderia->idguarderia}})">Reservar</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>



                <div class="col-md-6 col-lg-6 wow fadeIn" data-wow-delay="0.1s">
                     <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 600px;">
                        <img class="img-fluid img-responsive w-50 rounded-circle" src="{{url('/img/logos/')}}/{{$dataguarderia->idguarderia}}.png" alt="{{$dataguarderia->nombre}}">

                    </div>

                    <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 600px;">
                        <h3>Nuestras Politicas</h3>
                        <p class="mb-4 justify-content-end " style="text-align: justify">{{$dataguarderia->politicas}} </p>

                    </div>


                    <div class="row g-4 mb-5">
                        <div class="col-md-6 col-lg-4 text-center wow fadeInUp" data-wow-delay="0.1s">
                            <div class="bg-light rounded-circle d-inline-flex align-items-center justify-content-center mb-4" style="width: 75px; height: 75px;">
                                <i class="fa fa-map-marker-alt fa-2x text-primary"></i>
                            </div>
                            <h6>{{$dataguarderia->direccion}}</h6>
                        </div>
                        <div class="col-md-6 col-lg-4 text-center wow fadeInUp" data-wow-delay="0.3s">
                            <div class="bg-light rounded-circle d-inline-flex align-items-center justify-content-center mb-4" style="width: 75px; height: 75px;">
                                <i class="fa fa-envelope-open fa-2x text-primary"></i>
                            </div>
                            <h6>{{$dataguarderia->email}}</h6>
                        </div>
                        <div class="col-md-6 col-lg-4 text-center wow fadeInUp" data-wow-delay="0.5s">
                            <div class="bg-light rounded-circle d-inline-flex align-items-center justify-content-center mb-4" style="width: 75px; height: 75px;">
                                <i class="fa fa-phone-alt fa-2x text-primary"></i>
                            </div>
                            <h6>{{$dataguarderia->telefono}}</h6>
                        </div>
                    </div>
                </div>

   </div>


                <div class="bg-light rounded mt-5">
                    <div class="row g-0">
                        <div class="col-lg-12 wow fadeIn" data-wow-delay="0.5s" style="min-height: 400px;">
                            <div class="position-relative h-100">
                                <iframe class="position-relative rounded w-100 h-100"
                                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3001156.4288297426!2d-78.01371936852176!3d42.72876761954724!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4ccc4bf0f123a5a9%3A0xddcfc6c1de189567!2sNew%20York%2C%20USA!5e0!3m2!1sen!2sbd!4v1603794290143!5m2!1sen!2sbd"
                                frameborder="0" style="min-height: 400px; border:0;" allowfullscreen="" aria-hidden="false"
                                tabindex="0"></iframe>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Contact End -->
@stop
