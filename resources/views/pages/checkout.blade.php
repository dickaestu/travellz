@extends('layouts.checkout')
@section('title', 'Checkout')

@section('content')
      <!-- Main Content -->
      <main>
        <section class="section-details-header"></section>
        <section class="section-details-content">
            <div class="container">
                <div class="row">
                    <div class="col p-0">
                        <nav>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.html"
                                        style="text-decoration: none; color: #DB593F; font-weight: 300;">Paket
                                        Travel</a></li>
                                <li class="breadcrumb-item"><a href="details.html"
                                        style="text-decoration: none; color: #DB593F; font-weight: 300;">Details</a>
                                </li>
                                <li class="breadcrumb-item active">Checkout</li>
                            </ol>
                        </nav>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-8 pl-lg-0">
                        <div class="card card-details">
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{$error}}</li>
                            @endforeach
                        </ul>
                           </div>       
                          @endif
                            <h1 class="mb-0">Who is Going?</h1>
                        <p>{{$item->travel_package->title}}, {{$item->travel_package->location}}</p>
                            <div class="anttendee">
                                <table class="table table-responsive-sm text-center table-borderless">
                                    <thead>
                                        <tr class="border-bottom">
                                            <td>Picture</td>
                                            <td>Name</td>
                                            <td>Nationality</td>
                                            <td>VISA</td>
                                            <td>Passport</td>
                                            <td></td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($item->details as $detail)
                                        <tr>
                                        <td><img src="https://ui-avatars.com/api/?name={{$detail->username}}" class="rounded-circle" height="60"></td>
                                                <td class="align-middle">{{$detail->username}}</td>
                                                <td class="align-middle">{{$detail->nationality}}</td>
                                                <td class="align-middle">{{$detail->is_visa ? '30 Days' : 'N/A'}}</td>
                                                <td class="align-middle">{{Carbon\Carbon::createFromDate($detail->doe_passport) > Carbon\Carbon::now() ? 'Active' : 'Inactive'}}</td>
                                                <td class="align-middle"><a href="{{route('checkout-remove', $detail->id)}}"><img
                                                src="{{url('frontend/images/icon_delete.png')}}" height="18"></a></td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="6" class="text-center">No Visitor</td>
                                            </tr>
                                        @endforelse
                                       
                                    </tbody>
                                </table>
                            </div>
                            <div class="member mt-3">
                                <h2>Add Member</h2>
                                <form class="form-inline" method="post" action="{{route('checkout-create', $item->id)}}">
                                    @csrf
                                    <label for="username" class="sr-only">Name</label>
                                    <input required name="username" type="text" class="form-control mb-2 mr-sm-2"
                                        id="username" placeholder="Username">

                                    <label for="nationality" class="sr-only">Nationality</label>
                                    <input required style="width:50px" name="nationality" type="text" class="form-control mb-2 mr-sm-2"
                                            id="nationality" placeholder="Nationality">

                                    <label for="is_visa" class="sr-only">VISA</label>
                                    <select required name="is_visa" id="is_visa" class="custom-select mb-2 mr-sm-2">
                                        <option selected >VISA</option>
                                        <option value="1">30 Days</option>
                                        <option value="0">N/A</option>
                                    </select>

                                    <label for="doe_passport" class="sr-only">DOE Passport</label>
                                    <div class="input-group mb-2 mr-sm-2">
                                        <input type="text" name="doe_passport" class="form-control datepicker" id="doePassport"
                                            placeholder="DOE Passport">
                                    </div>

                                    <button type="submit" class="btn btn-add-now mb-2 px-4">Add Now</button>

                                </form>

                                <h3 class="note mt-2 mb-0">Note</h3>
                                <p class="disclaimer mb-0">You are only able to invite member that has registered in
                                    Travellz</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="card card-details card-right">
                            <h2>Checkout Informations</h2>
                            <table class="trip-information">
                                <tr>
                                    <th width="50%">Members</th>
                                <td width="50%" class="text-right">{{$item->details->count()}} person</td>
                                </tr>

                                <tr>
                                    <th width="50%">Additional VISA</th>
                                    <td width="50%" class=" text-right">IDR {{number_format($item->additional_visa)}}</td>
                                </tr>

                                <tr>
                                    <th width="50%">Trip Price</th>
                                    <td width="50%" class=" text-right">{{number_format($item->travel_package->price)}} /person</td>
                                </tr>

                                <tr>
                                    <th width="30%">Sub Total</th>
                                    <td width="70%" class=" text-right">IDR {{number_format($item->transaction_total)}}</td>
                                </tr>
                                <tr>
                                    <th width="30%">Total(+unique code)</th>
                                    <td width="70%" class="text-price text-right">IDR {{number_format($item->transaction_total)}}.<span
                                            class="text-unique">{{mt_rand(0,99)}}</span></td>
                                </tr>
                            </table>
                            <hr>
                            <h2>Payment Instruction</h2>
                            <p class="payment-instruction">Please complete payment before you
                                continue the wonderful trip</p>
                            <div class="bank">
                                <div class="bank-item pb-3">
                                <img src="{{url ('frontend/images/icon_bank.png')}}" class="bank-image">
                                    <div class="description">
                                        <h3>
                                            PT Travellz
                                        </h3>
                                        <p>
                                            2145919249
                                            <br>
                                            Bank Central Asia
                                        </p>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>

                                <div class="bank-item pb-3">
                                <img src="{{ url ('frontend/images/icon_bank.png') }}" class="bank-image">
                                    <div class="description">
                                        <h3>
                                            PT Travellz
                                        </h3>
                                        <p>
                                            21512561235
                                            <br>
                                            Bank HSBC
                                        </p>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        </div>
                        <div class="join-container">
                            <a href="{{route('checkout-success',$item->id)}}" type="button" class="btn btn-block btn-join-now mt-3 py-2" >I Have Mad Payment</a>
                        </div>
                        <div class="text-center mt-3">
                            <a href="{{route('detail', $item->travel_package->slug)}}" class="text-muted">Cancel Booking</a>
                        </div>
                    </div>
                </div>
            </div>

        </section>
    </main>

     <!-- Modal Success Checkout-->
     <div class="modal fade" data-backdrop="static" id="successCheckout" tabindex="-1" role="dialog"
     aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
     <div class="modal-dialog modal-dialog-centered" role="document">
         <div class="modal-content">
             <div class="modal-body success-checkout">
                 <div class="container success-content p-5">
                     <div class="row justify-content-center">
                     <img src="{{url('frontend/images/ic_success.png')}}" class="mb-3" height="104">
                     </div>

                     <h3 class="text-center mt-3">Wohoo! Success</h3>
                     <p class="text-center">We've sent you email for trip instruction <br>
                         please read it as well</p>

                     <div class="col text-center">
                         <a href="{{route('home')}}" class="btn btn-home-page">Home Page</a>
                     </div>
                 </div>
             </div>
         </div>
     </div>
 </div>
@endsection

@push('prepend-style')
<link rel="stylesheet" href="{{url('frontend/libraries/gijgo/css/gijgo.min.css')}}">
@endpush

@push('addon-script')
<script src="{{url('frontend/libraries/gijgo/js/gijgo.min.js')}}"></script>

<script>
    $(document).ready(function () {
        $('.datepicker').datepicker({
            format: 'yyyy-mm-dd',
            uiLibrary: 'bootstrap4',
            icons: {
                rightIcon: '<img src="{{url('frontend/images/icon_date.png')}}">'
            }
        })
    });
</script>
@endpush