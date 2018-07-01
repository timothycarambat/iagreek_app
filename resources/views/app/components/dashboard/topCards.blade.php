<div class="row">

<a href="/members">
    <div class="col-lg-3 col-sm-6">
        <div class="card">
            <div class="content">
                <div class="row">
                    <div class="col-xs-5">
                        <div class="icon-big icon-warning text-center">
                            <i class="fas fa-users"></i>
                        </div>
                    </div>
                    <div class="col-xs-7">
                        <div class="numbers">
                            <p>Members</p>
                            {{Auth::user()->org_size()}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</a>

<a href="/documents">
    <div class="col-lg-3 col-sm-6">
        <div class="card">
            <div class="content">
                <div class="row">
                    <div class="col-xs-5">
                        <div class="icon-big icon-success text-center">
                            <i class="fas fa-file-alt"></i>
                        </div>
                    </div>
                    <div class="col-xs-7">
                        <div class="numbers">
                            <p>Documents</p>
                            {{Auth::user()->documents()->count()}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</a>

<a href="/campaigns">
    <div class="col-lg-3 col-sm-6">
        <div class="card">
            <div class="content">
                <div class="row">
                    <div class="col-xs-4">
                        <div class="icon-big icon-danger text-center">
                            <i class="fas fa-bullhorn"></i>
                        </div>
                    </div>
                    <div class="col-xs-8">
                        <div class="numbers">
                            <p>Campaigns (Active)</p>
                            {{Auth::user()->campaigns()->where('archived',false)->count()}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</a>

  </div>
