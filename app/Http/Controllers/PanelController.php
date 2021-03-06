<?php namespace Exchanger\Http\Controllers;

use Hash;
use Auth;
use Exchanger\User;
use Exchanger\Price;
use Exchanger\BitAnd;
use Exchanger\Transaction;
use Illuminate\Http\Request;

use Illuminate\Routing\Controller as BaseController;
use Exchanger\Http\Controllers\Controller ;

class PanelController extends Controller {

	public function __construct()
	{
		$this->middleware('auth');
		parent::__construct();
		$this->data["navigation_menu"] = "panel";
		$this->data["csrf_token"] = csrf_token();
		$this->data["loginuser"] = User::find(Auth::user()->id);

		$user = $this->data["loginuser"];
		$this->data["is_user"] = false;
		$this->data["is_admin"] = false;
		$this->data["is_super"] = false;

		if (BitAnd::check($user->access_level, 1)) {
			$this->data["is_user"] = true;
		}
		if (BitAnd::check($user->access_level, 2)) {
			$this->data["is_admin"] = true;
		}
		if (BitAnd::check($user->access_level, 4)) {
			$this->data["is_super"] = true;
		}
	}

	public function getIndex() {
		return view("panel.index", $this->data);

	}

	public function getLogout() {
		Auth::logout();

		return redirect()->to("login");
	}

	public function postChangePrice(Request $request) {
//		echo "ok";
		$price_id = $request->input("price_id");
		if ($price_id == 1) {
			Price::setUSDBuy($request->input("price"));
		} else if ($price_id == 3) {
			Price::setMYRBuy($request->input("price"));
		} else if ($price_id == 5) {
			Price::setBAHTBuy($request->input("price"));
		} else if ($price_id == 7) {
			Price::setIDRBuy($request->input("price"));
		} else if ($price_id == 2) {
			Price::setUSDSell($request->input("price"));
		} else if ($price_id == 4) {
			Price::setMYRSell($request->input("price"));
		} else if ($price_id == 6) {
			Price::setBAHTSell($request->input("price"));
		} else if ($price_id == 8) {
			Price::setIDRSell($request->input("price"));
		}

		return redirect()->back()->with("success", "Succesfully change price");
	}

	public function postAddUtoken(Request $request) {
		if (!is_numeric($request->input("value"))) {
			return redirect()->back()->with("error", "Error: Value must integer");
		}

		Transaction::add($request->input("value"));
		return redirect()->back()->with("success", "Successfully update UToken in System");
	}

	public function postSubUtoken(Request $request) {
		if (!is_numeric($request->input("value"))) {
			return redirect()->back()->with("error", "Error: Value must integer");
		}

		$limit = Transaction::getUToken();
		if ( $limit < $request->input("value")) {
			return redirect()->back()->with("error", "Error: Value Exceed limit. The limit is : " . $limit);
		}

		Transaction::sub($request->input("value"));
		return redirect()->back()->with("success", "Successfully update UToken in System");
	}

}
