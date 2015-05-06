@extends("app")

@section("pageTitle", "Blank Template")

@section("content")
	<div class="toolbar">
		<div class="toolbar-inner shadow fixed">
			<a class="icon-button ripple morph" href="javascript:" data-side-navigation=".side-navigation">
				<i data-icon="menu" class="white" ></i>
				<i data-icon="arrow-left" class="white" ></i>
			</a>
			<div class="toolbar-title">Devsign.My</div>
			<div style="padding-left: 16px; padding-right: 16px;">
				<div class="pull-right">
					<a class="icon-button ripple" href="javascript:" data-popup=".popup">
						<i data-icon="bell" class="white"></i>
					</a>
					<div class="popup">
						<div class="row">
							<div class="col-xs-1">
								<img src="/img/profile.png" class="img-responsive" />
							</div>
							<div class="col-xs">
								
							</div>
						</div>
					</div>
					<input type="checkbox" class="white-blue large" data-switch="" name="value_1" value="1" />
				</div>
			</div>
			
		</div>
	</div>
	
	<div style="padding: 16px; max-width: 1312px; margin: 0 auto">
		@include('templates.page-message', compact("success", "error"))
		<div class="card">
			<form method="POST" action="/panel/user/password" style="margin: 0">
				<div class="card-title">
					<div class="font-title font-normal">Change User Password</div>
					<input type="hidden" name="_token" value="{{ $csrf_token }}">
					<input type="hidden" name="user_id" value="{{ $encrypted_id }}">
					<div class="row">
						<div class="col-xs-fluid-8">
							<input type="password" placeholder="Old Password" name="old_password" data-normal-input />
						</div>
					</div>
					<div class="row">
						<div class="col-xs-fluid-8">
							<input type="password" placeholder="New Password" name="password" data-normal-input />
						</div>
						<div class="col-xs-fluid-8">
							<input type="password" placeholder="Confirm Password" name="confirm_password" data-normal-input />
						</div>
					</div>
				</div>
				<div class="card-action">
					<div class="pull-right">
						<button type="submit" class="flat-button primary m-r-8 ripple">Change Password</button>
					</div>
				</div>
			</form>
			
		</div>
	</div>
@stop