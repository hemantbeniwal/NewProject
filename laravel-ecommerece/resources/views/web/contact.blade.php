@extends('layouts.web-front')
@section('content')
<div class="contact-box-main">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-sm-12">
                <div class="contact-form-right">
                    <h2>GET IN TOUCH</h2>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed odio justo, ultrices ac nisl sed, lobortis porta elit. Fusce in metus ac ex venenatis ultricies at cursus mauris.</p>
                    <form action="{{route('enquiry.store')}}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input type="text" class="form-control" id="name" name="name" placeholder="Your Name"
                                    value="{{ old('name') }}">
                                    @error('name')
                                        <span class="error">{{ $message }}</span>
                                    @enderror
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input type="text" placeholder="Your Email" id="email" class="form-control" name="email"
                                    value="{{ old('email') }}">
                                    @error('email')
                                        <span class="error">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input type="number" placeholder="Your Phone" class="form-control" name="phone"
                                    value="{{ old('phone') }}">
                                    @error('phone')
                                        <span class="error">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <select name="status" class="form-control">
                                        <option value="" selected disabled>Select</option>
                                        <option value="1" {{ old('status') == 1 ? 'selected' : null }}>Enable</option>
                                        <option value="2" {{ old('status') == 2 ? 'selected' : null }}>Disable</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <textarea name="message" class="form-control" id="message" placeholder="Your Message" rows="4" data-error="Write your message" ></textarea>
                                    <div class="help-block with-errors"></div>
                                </div>
                                <div class="submit-button text-center">
                                    <button class="btn hvr-hover" id="submit" type="submit">Save</button>
                                    <div id="msgSubmit" class="h3 text-center hidden"></div>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-lg-4 col-sm-12">
                <div class="contact-info-left">
                    <h2>CONTACT INFO</h2>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent urna diam, maximus ut ullamcorper quis, placerat id eros. Duis semper justo sed condimentum rutrum. Nunc tristique purus turpis. Maecenas vulputate. </p>
                    <ul>
                        <li>
                            <p><i class="fas fa-map-marker-alt"></i>Address: Michael I. Days 9000 <br>Preston Street Wichita,<br> KS 87213 </p>
                        </li>
                        <li>
                            <p><i class="fas fa-phone-square"></i>Phone: <a href="tel:+1-888705770">+1-888 705 770</a></p>
                        </li>
                        <li>
                            <p><i class="fas fa-envelope"></i>Email: <a href="mailto:contactinfo@gmail.com">contactinfo@gmail.com</a></p>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection