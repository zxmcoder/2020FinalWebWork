package main

import (
	"errors"
	"encoding/json"
	"fmt"
	"gorm.io/driver/mysql"
	"gorm.io/gorm"
	"log"
	"github.com/streadway/amqp"
)

//JSON TicketOrder
type TicketOrder struct {
    User_id string `json:"user_id"`
    Ticket_id string `json:"ticket_id"`
}

//Gorm Ticket
type Ticket struct {
	Ticket_id string `gorm:"primaryKey"`
	Ticket_num int `gorm:"column:ticket_num"`
}

//Gorm User
type User struct {
	User_id string `gorm:"primaryKey"`
	User_password string `gorm:"column:user_password"`
	User_ticket string `gorm:"column:user_ticket"`
}

func main() {
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
	if err3!=nil {
		log.Fatal(err3)
	}
	msgs, err4 := ch.Consume(q.Name, "", true, false, false, false, nil)
	if err4!=nil {
		log.Fatal(err4)
	}
	forever := make(chan bool)
	go func() {
		for d := range msgs {
			log.Printf("Received a message: %s", d.Body)
			//连接数据库
			dsn := "web_zxmcoder_cn:3jie4Wt5kP@tcp(127.0.0.1:3306)/web_zxmcoder_cn?charset=utf8mb4&parseTime=True&loc=Local"
			db, err5 := gorm.Open(mysql.Open(dsn), &gorm.Config{})
			if err5 != nil {
				fmt.Println(err5)
			}
			fmt.Println("------------连接数据库成功-----------")
			//JSON格式的数据通过Unmarshal映射到结构体order
			var order TicketOrder
			if err6 := json.Unmarshal(d.Body, &order); err6 != nil {
				fmt.Printf("Unmarshal err, %v\n", err6)
				continue
			}
			//进行写数据库操作
			user1 := User{}
			errUser1 := db.Table("user").Where("user_id = ?", order.User_id).First(&user1).Error
			if errors.Is(errUser1, gorm.ErrRecordNotFound) {
				fmt.Println("用户不存在")
				continue
			}
			ticket1 := Ticket{}
			errTicket1 := db.Table("ticket").Where("ticket_id = ?", order.Ticket_id).First(&ticket1).Error
			if errors.Is(errTicket1, gorm.ErrRecordNotFound) {
				fmt.Println("火车票不存在")
				continue
			}
			if ticket1.Ticket_num <=0 {
				fmt.Println("火车票余票不足")
				continue
			}
			if user1.User_ticket != "0" {
				fmt.Println("用户已经买票")
				continue
			}
			// 开始更新
			user1.User_ticket = order.Ticket_id
			db.Table("user").Save(&user1)
			ticket1.Ticket_num --
			db.Table("ticket").Save(&ticket1)
		}
	}()
	log.Printf(" [*] Waiting for messages. To exit press CTRL+C")
	<-forever
}
