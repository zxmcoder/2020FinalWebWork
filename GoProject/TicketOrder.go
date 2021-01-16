package main

import (
	"encoding/json"
	"fmt"
	"io"
	"log"
	"net/http"
	"io/ioutil"
	"github.com/streadway/amqp"
)

//Ret ...
type Ret struct {
	Code int    `json:"code,int"`
	Data string `json:"data"`
}

//Order

type TicketOrder struct {
    User_id string `json:"user_id"`
    Ticket_id string `json:"ticket_id"`
}

func printRequest(w http.ResponseWriter, r *http.Request) {
	// fmt.Println("r.Form=", r.Form) //这些信息是输出到服务器端的打印信息 , Get参数
	// fmt.Println(r.Method) //直接访问129.211.57.153:39999/api/room/order就是GET，PHP那边发过来是POST

	//下面这些代码处理的是ReturnJSON
	//PHP拿到Code=200之后就认为自己提交的请求被收到了
	ret := new(Ret)
	ret.Code = 200
	ret.Data = "提交成功"
	w.Header().Set("Content-Type", "application/json; charset=utf-8")
	retJSON, _ := json.Marshal(ret)
	io.WriteString(w, string(retJSON))
	//那么我们发过来的数据在哪里呢？r里面
	if r.Method == "POST" {
		body, err := ioutil.ReadAll(r.Body)
		if err != nil {
			fmt.Printf("read body err, %v\n", err)
			return
		}
		//fmt.Println(body)
		fmt.Println(string(body))
		// ans := string(body)
		// fmt.Println(ans[0])

		var order TicketOrder
		if err = json.Unmarshal(body, &order); err != nil {
			fmt.Printf("Unmarshal err, %v\n", err)
			return
		}
		//order.room_floor="1"
		fmt.Printf("%+v", order)
		fmt.Println()
		// fmt.Println(order.student_id_1)

		conn,err1 := amqp.Dial("amqp://admin:admin@129.211.57.153:5672/")
		if err1 != nil {
			log.Fatal(err1)
		}
		defer conn.Close() //延迟执行
		ch,err2 := conn.Channel()
		if err2 != nil {
			log.Fatal(err2)
		}
		defer ch.Close()
		q, err3 := ch.QueueDeclare("hello", false, false, false, false, nil)
		if err3 != nil {
			log.Fatal(err3)
		}
		err4 := ch.Publish("", q.Name, false, false, amqp.Publishing{
			ContentType: "text/plain",
			Body:[]byte(body),
		})
		if err4 != nil {
			log.Fatal(err4)
		}
	}
}

func sayMore(w http.ResponseWriter, r *http.Request) {
	r.ParseForm() //解析参数，默认是不会解析的
	printRequest(w, r)
}

func main() {
	http.HandleFunc("/api/ticketorder", sayMore) //设置访问的路径
	err := http.ListenAndServe(":39999", nil)    //设置监听的端口
	if err != nil {
		log.Fatal("ListenAndServe: ", err)
	}
}