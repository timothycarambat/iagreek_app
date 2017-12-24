@extends('marketing.layout')

@section('main_content')

  @include('marketing.navbar')
  <article id="main">
    <header>
      <h2>What is this all about?</h2>
    </header>
    <section class="wrapper style5">
      <div class="inner">

        <h3>What exactly am I signing up for?</h3>
        <p>
          When you sign up with IAGREEK you are making the choice to create, disseminate, and track your documents.
          With IAGREEK you able to create all the custom and specialized documents you need when signing on potential new members or maintaing active members for your Greek Organization.
          <br><br>
          In addition to having the documents online and digital, they will also be able to signed digitally. After siging both the responsible party (you!) and whoever the signee was will recieve email reciepts of the document, as well as online here!
          Keep track of documents needing signatures by sending out mailing campaigns and text notifications as well as viewing who hasnt signed a document yet.
          <br><br>
          You only need one account to get started and your members do not even need to sign up indvidually! All documents are signed and verifed on our secure server!
        </p>

        <p> Get started with a 15 day trial (if you dont like it dont worry! Youll get all your signed or submitted documents sent to you!)</p>
        <div align='center'>

          <p style="font-style:italic">Pricing is arranged by Organization size and you will automatically be alerted if youre about to switch plans!</p>
        <div class="row" style="text-align: center;">
              <div class="col-md-3 col-sm-6" style='float: none;display: inline-block;text-align: left;'>
                  <div class="pricingTable">
                      <div class="pricingTable-header">
                          <span class="price-value">10<span class="currency">$</span></span>
                          <h3 class="title">Small</h3>
                      </div>
                      <ul class="pricing-content">
                          <li>50GB Disk Space</li>
                          <li>50 Email Accounts</li>
                          <li>50GB Monthly Bandwidth</li>
                          <li>10 Subdomains</li>
                          <li>15 Domains</li>
                      </ul>
                      <a href="#" class="pricingTable-signup">Sign Up</a>
                  </div>
              </div>
              <div class="col-md-3 col-sm-6" style='float: none;display: inline-block;text-align: left;'>
                  <div class="pricingTable green">
                      <div class="pricingTable-header">
                          <span class="price-value">20<span class="currency">$</span></span>
                          <h3 class="title">Medium</h3>
                      </div>
                      <ul class="pricing-content">
                          <li>60GB Disk Space</li>
                          <li>60 Email Accounts</li>
                          <li>60GB Monthly Bandwidth</li>
                          <li>15 Subdomains</li>
                          <li>20 Domains</li>
                      </ul>
                      <a href="#" class="pricingTable-signup">Sign Up</a>
                  </div>
              </div>

              <div class="col-md-3 col-sm-6" style='float: none;display: inline-block;text-align: left;'>
                  <div class="pricingTable orange">
                      <div class="pricingTable-header">
                          <span class="price-value">20<span class="currency">$</span></span>
                          <h3 class="title">Large</h3>
                      </div>
                      <ul class="pricing-content">
                          <li>60GB Disk Space</li>
                          <li>60 Email Accounts</li>
                          <li>60GB Monthly Bandwidth</li>
                          <li>15 Subdomains</li>
                          <li>20 Domains</li>
                      </ul>
                      <a href="#" class="pricingTable-signup">Sign Up</a>
                  </div>
              </div>
          </div>

                  </div>


        <hr />

        <h4>Okay, but like, why?</h4>
        <p> Here will be some information and graphics on how its used.</p>



      </div>
    </section>
  </article>

  <section id="cta" class="wrapper style4">
    <div class="inner">
      <header>
        <h2>See what we mean?</h2>
        <p>Get started today by siging up and making some documents.</p>
      </header>
      <ul class="actions vertical">
        <li><a href="/register" class="button fit special">Sign me Up!</a></li>
      </ul>
    </div>
  </section>
@endsection

@section('page_script')
<script type="text/javascript">
  $('#header').removeClass('alt');
</script>
@endsection
