
@include('header')

@include('nav', ['q' => false])
<style type="text/css">
  @media (max-width: 1300px) {
    section.pricing-plans {
      background: #fff;
      margin-top: 150px;
      margin-left: 15%;
      margin-right: 15%;

    }
  }
  @media (min-width: 1300px) {
    section.pricing-plans {
      background: #fff;
      margin-top: 150px;
      margin-left: 25%;
      margin-right: 25%;

    }
  }

  .pricing-box {
    padding-left: 5px;
    padding-right: 5px;
    padding-top: 20px;
    padding-bottom: 20px;

    background: #fff;
    border: 1px solid #e1e8ee;
  }

  .pricing-box .card-title {
    font-size: 1rem;
    line-height: 2;
  }

  .pricing-box .currency {
    top: -1.50rem;
    font-size: 1.50rem;
    letter-spacing: 0.75rem;
    margin-right: -1.5rem;
  }

  .pricing-box .amount {
    font-size: 3.8rem;
  }

  .pricing-box .month {
    color: #a1a2ac;
    margin-left: -0.8rem;
  }

  .pricing-box .list-group {
    margin-bottom: 1rem;
  }

  .pricing-box .list-group-item {
    padding: 0.45rem 1rem;
    border: none;
  }

  .pricing-premium {
    position: relative;
    z-index: 1;
    -webkit-box-shadow: 0 5px 10px rgba(0,0,0,.09);
    -moz-box-shadow: 0 5px 10px rgba(0,0,0,.09);
    box-shadow: 0 5px 10px rgba(0,0,0,.09);
  }

  @media (max-width: 895px) {
    .pricing-box {
      margin-bottom: 1rem;
    }
  }

  @media (min-width: 895px) {
    .pricing-premium {
      -webkit-transform: scale(1.05);
      -moz-transform: scale(1.05);
      transform: scale(1.05);
    }
  }
  .payMethod{
    height: 35px;
    width: 125px;
  }
</style>

<body>

  <section class="pricing-plans text-center">
    <div class="container">
      <div class="row">
        <div class="col-md animated slideInRight">
          <div class="card pricing-box rounded">
            <div class="card-block">
              <h4 class="card-title">
                Basic
              </h4>
              <h6 class="card-text">

                <span class="amount">
                                      Free
                </span>
              </h6>
            </div>
            <ul class="list-group list-group-flush">
              <li class="list-group-item text-center d-inline-block">
                Access to questions by our teachers
              </li>
              <li class="list-group-item text-center d-inline-block">
                Find IB study mates
              </li>
              <li class="list-group-item text-center d-inline-block">
                Join discussions
              </li>
              <li class="list-group-item text-center d-inline-block">
                More to be developed...
              </li>
            </ul>
          </div>
        </div>
        <div class="col-md">
          <div class="card pricing-box pricing-premium">
            <div class="card-block">
              <h4 class="card-title">
                Pro
              </h4>
              <h6 class="card-text">
                <sup class="currency">
                  $
                </sup>
                <span class="amount">
                    1.99
                </span>
                <span class="month">
                    / mo
                </span>
              </h6>
            </div>
            <ul class="list-group list-group-flush">
              <li class="list-group-item text-center d-inline-block">
                Everything from Basic
              </li>
              <li class="list-group-item text-center d-inline-block">
                Access to questions from past paper
              </li>
              <li class="list-group-item text-center d-inline-block">
                Pro badge <span class="badge proBadge">Pro</span>
              </li>
              <li class="list-group-item text-center d-inline-block">
                No ads
              </li>
              <li class="list-group-item text-center d-inline-block">
                More to be developed...
              </li>
            </ul>
            <div class="card-block">
              @if ($isPro)
                <button class="btn btn-success" disabled data-toggle="modal" data-target="#payModal" id="proTill">
                </button>
              @else
                <button class="btn btn-outline-success" data-toggle="modal" data-target="#payModal">
                  Get Started
                </button>
              @endif
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>


  <!-- Modal -->
  <div class="modal fade" id="payModal" tabindex="-1">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Select a paying method</h5>
          <button type="button" class="close" data-dismiss="modal">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <a href="/payWithPaypal">
            <img src="https://cdn-bucket.ibkiller.com/img/PayPal.svg">
          </a>
          <img src="https://cdn-bucket.ibkiller.com/img/AliPay_logo.svg" class="payMethod">
          <img src="http://www.hangzhouredcross.org/themes/redcross/img/payments/wxpay.png" class="payMethod">

        </div>
      </div>
    </div>
  </div>
</body>

<script type="text/javascript">
  $("#proTill").html('Pro till ' + timestampToTime({{$proSince}} + 2678400));
</script>

