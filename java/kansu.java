public class kansu {

    public static void main(String[] args) {
        // TODO 自動生成されたメソッド・スタブ
    	
    	

    	System.out.println(totalPrice(300) + "<br>");
	    System.out.println(totalPrice(450) + "<br>");
	    System.out.println(totalPrice(400) + "<br>");
	    System.out.println(totalPrice(350) + "<br>");
    }
	public static int totalPrice(int fruitPrice) {
		return (int) (fruitPrice * 1.10) + 350;
	}

}