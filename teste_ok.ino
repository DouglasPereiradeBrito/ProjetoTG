#include <hspi_slave.h>
#include <SPISlave.h>
#include <ESP8266HTTPClient.h>
#include <SPI.h>
#include <MFRC522.h>
#include <ESP8266WebServer.h>
#include <ESP8266mDNS.h>
#include <LiquidCrystal_I2C.h>
#include <Wire.h>

#define RST_PIN         D1          
#define SS_PIN          D2          

LiquidCrystal_I2C lcd(0x27, 16, 2);

//const char* ssid = "DouglasBrito";
//const char* password = "123456789*-Douglas25051997";


const char* ssid = "FatecWiLab-03";
//const char* ssid = "FatecWiLab-07";
//const char* ssid = "FatecWi";

int i = 0, j = 0, k = 0, delayTime2 = 350;  

ESP8266WebServer server(80);

MFRC522 mfrc522(SS_PIN, RST_PIN);

String leitura, uidLeitura;

void setup() { 
  Serial.begin(115200);                                           
  SPI.begin();                                                 
  mfrc522.PCD_Init();                                          

  WiFi.mode(WIFI_STA);
  WiFi.begin(ssid);
  //WiFi.config(ip, gateway, subnet); 
  //WiFi.begin(ssid, password);
  Serial.println("");
  Wire.begin(D3, D4);
  lcd.home();
  lcd.begin();
  // Wait for connection
  while (WiFi.status() != WL_CONNECTED) {
    delay(500);
    Serial.print(".");
  }
  Serial.println("");
  Serial.print("Connected to ");
  Serial.println(ssid);
  Serial.print("IP address: ");
  Serial.println(WiFi.localIP());

  if (MDNS.begin("esp8266")) {
    Serial.println("MDNS responder started");
  }
  server.on("/", rfidProcess);

  server.on("/lcd", showTAg);

  server.on("/cadastro", show);

  /*server.on("/ip", []() {
    server.sendHeader("Access-Control-Allow-Origin", "*");
    server.send(200, "application/json","{ \"tag\" : [{ \"ip\" : \"" + WiFi.localIP().toString() + "\"}]}");
  });*/
  
  server.onNotFound(handleNotFound);

  server.begin();
  Serial.println("HTTP server started");

  if(WiFi.status() == WL_CONNECTED){
   HTTPClient http;
   http.begin("http://192.168.103.173/ProjetoTG/public/webService/create/"+ WiFi.localIP().toString());
   http.addHeader("Access-Control-Allow-Origin", "*");
   http.addHeader("Content-Type", "application/json");
   int httpCode = http.GET();
   String payload = http.getString(); 
   Serial.println(httpCode);
   Serial.println(payload);
   http.end();
 }else{
    Serial.println("Error in WiFi connection");   
 }
}

//*****************************************************************************************//
void loop() {
  String leitura = "", payload = "", url = "";
  int tamanho = 0, httpCode = 0;
  server.handleClient();  
  /*leitura = teste();
  
  if(leitura.length() > 16){
    url = "http://192.168.103.173/ProjetoTG/public/tag/showTag/0&" + WiFi.localIP().toString(); 
  }else{
    url = "http://192.168.103.173/ProjetoTG/public/tag/showTag/" + leitura + "&" + WiFi.localIP().toString();
  }
  
  HTTPClient http;
  Serial.println(url);
  http.begin(url);
  http.addHeader("Access-Control-Allow-Origin", "*");
  http.addHeader("content-type", "application/x-www-form-urlencoded");
  httpCode = http.GET();
  payload = http.getString(); 
  Serial.println(httpCode);
  Serial.println(payload);
  http.end();

  lcd.setCursor(0, 0);
  lcd.print("                ");
  lcd.setCursor(0, 1);
  lcd.print("               ");
  
  if(payload != NULL && payload != "" && httpCode != 404){
    if(payload.substring(2, payload.indexOf(',') - 1).length() != 0){
      if(payload.substring(2, payload.indexOf(',') - 1).length() > 16){
        if(payload.substring(payload.indexOf(',') + 2, payload.length() -2).length() == 3){
          scrollInFromRight(0, payload.substring(2, payload.indexOf(',') - 1),
          "R$ " + payload.substring(payload.indexOf(',') + 2, payload.length() -2), 
          payload.substring(payload.indexOf(',') + 2, payload.length() + 2).length());
        }else if(payload.substring(payload.indexOf(',') + 2, payload.length() -2).length() == 4){
          scrollInFromRight(0, payload.substring(2, payload.indexOf(',') - 1), 
          "R$ " + payload.substring(payload.indexOf(',') + 2, payload.length() -2), 
          payload.substring(payload.indexOf(',') + 2, payload.length() -2).length());
        }else{
          scrollInFromRight(0, payload.substring(2, payload.indexOf(',') - 1), 
          "R$ " + payload.substring(payload.indexOf(',') + 2, payload.length() -2),
          payload.substring(payload.indexOf(',') + 2, payload.length() -2).length());
        }
      }else{
        if(payload.substring(2, payload.indexOf(',') - 1).length() != 0){
          lcd.setCursor(0, 0);
          lcd.print("                ");
          lcd.setCursor(0, 0);
          lcd.print(payload.substring(2, payload.indexOf(',') - 1));
          if(payload.substring(payload.indexOf(',') + 2, payload.length() -2).length() == 3){
            lcd.setCursor(0, 1);
            lcd.print("R$ " + payload.substring(payload.indexOf(',') + 2, payload.length() -2));
          }else if(payload.substring(payload.indexOf(',') + 2, payload.length() -2).length() == 4){
            lcd.setCursor(4, 1);
            lcd.print("R$ " + payload.substring(payload.indexOf(',') + 2, payload.length() -2));
          }else{
            lcd.setCursor(4, 1);
            lcd.print("R$ " + payload.substring(payload.indexOf(',') + 2, payload.length() -2));
          }
        }
      }
    }
  }
  
  delay(750); 
  leitura = "";
  delay(500);*/
}



void scrollInFromRight (int line, String str1, String preco, int linha) {
  i = str1.length();
  int x = 0;
  for (j = i; j >= (16 - i); j--) {
    if(j <= 15){
      lcd.setCursor(0, line);
      for (k = 0; k <= 15; k++) {
        lcd.print(" "); 
      }
      if(j >= 0){
          lcd.setCursor(j, line);
          lcd.print(str1);
          if(preco.length() == 7){
          lcd.setCursor(0, 1);
          lcd.print("    ");
          lcd.setCursor(linha, 1);
          lcd.print(preco);
        }else if(preco.length() == 8){
          lcd.setCursor(0, 1);
          lcd.print("     ");
          lcd.setCursor(4, 1);
          lcd.print(preco);
        }else if(preco.length() == 9){
          lcd.setCursor(0, 1);
          lcd.print("   ");
          lcd.setCursor(3, 1);
          lcd.print(preco);
        } 
      }else{
        x++;
        lcd.setCursor(0, line);
        lcd.print(str1.substring(x, i));  
      }
      delay(delayTime2);
    }
  }
}
  
void handleNotFound() {
  String message = "File Not Found\n\n";
  message += "URI: ";
  message += server.uri();
  message += "\nMethod: ";
  message += (server.method() == HTTP_GET) ? "GET" : "POST";
  message += "\nArguments: ";
  message += server.args();
  message += "\n";
  for (uint8_t i = 0; i < server.args(); i++)
    message += " " + server.argName(i) + ": " + server.arg(i) + "\n";

  server.send(404, "text/plain", message);
}

void showTAg(){
  if (server.hasArg("name") && server.hasArg("price")){
    lcd.clear();
    lcd.print(server.arg("name"));
    if(server.arg("price").length() == 3)
      lcd.setCursor(server.arg("price").length() + 2, 1);
     else if(server.arg("price").length() == 4)
      lcd.setCursor(server.arg("price").length(), 1);
     else
      lcd.setCursor(server.arg("price").length() - 2, 1);
    lcd.print("R$ "+server.arg("price"));
    server.sendHeader("Access-Control-Allow-Origin", "*");
    server.send(200, "application/json", "{ \"data\" : [{ \"r\" : \"0\"}]}");
  }
}

void show(){
  String json = "{ \"data\" : ", qtd = "", retorno = "";
  int timeout = 0;
  do{
    Serial.println("Lendo"); 
    retorno = leituraUid();
    delay(1000);
    timeout++;
    if(timeout == 10){
      retorno = "nda";
      break;
    }
  }while(retorno == "1" || retorno == "0");
  server.sendHeader("Access-Control-Allow-Origin", "*");
  server.send(200, "application/json", "{ \"data\" : [{ \"uid\" : \"" + retorno + "\"}]}");
}

void rfidProcess() {
  String leitura;
  do{
    leitura = teste();
    Serial.println("lendo");
    delay(1000);
  }while(leitura == "1" || leitura == "0");
  server.sendHeader("Access-Control-Allow-Origin", "*");
  server.send(200, "application/json", "{ \"data\" : [{ \"uid\" : \"" + leitura + "\"}]}");
}

String teste(){
  MFRC522::MIFARE_Key key;
  for (byte i = 0; i < 6; i++) key.keyByte[i] = 0xFF;

  byte block;
  byte len;
  MFRC522::StatusCode status;
  
  if (mfrc522.PICC_IsNewCardPresent()) {
    mfrc522.PICC_ReadCardSerial();
    Serial.println(F("**Card Detected:**"));
  
    Serial.print(F("Card UID:"));
    String conteudo = "";
    for (byte i = 0; i < mfrc522.uid.size; i++) {
      conteudo.concat(String(mfrc522.uid.uidByte[i] < 0x10 ? "0" : ""));
      conteudo.concat(String(mfrc522.uid.uidByte[i], HEX));
      Serial.print(mfrc522.uid.uidByte[i] < 0x10 ? " 0" : " ");
      Serial.print(mfrc522.uid.uidByte[i], HEX);
    }
    delay(1000);
    mfrc522.PICC_HaltA();
    mfrc522.PCD_StopCrypto1();
    
    return conteudo;
  }else{
    mfrc522.PICC_ReadCardSerial();
    Serial.println(F("**Card Detected:**"));
    
    Serial.print(F("Card UID:"));    //Dump UID
    String conteudo = "";
    for (byte i = 0; i < mfrc522.uid.size; i++) {
      conteudo.concat(String(mfrc522.uid.uidByte[i] < 0x10 ? "0" : ""));
      conteudo.concat(String(mfrc522.uid.uidByte[i], HEX));
      Serial.print(mfrc522.uid.uidByte[i] < 0x10 ? " 0" : " ");
      Serial.print(mfrc522.uid.uidByte[i], HEX);
    }
    delay(1000);
    mfrc522.PICC_HaltA();
    mfrc522.PCD_StopCrypto1();
    
    return conteudo;
  }
}

String leituraUid(){
    MFRC522::MIFARE_Key key;
  for (byte i = 0; i < 6; i++) key.keyByte[i] = 0xFF;

  //some variables we need
  byte block;
  byte len;
  MFRC522::StatusCode status;

  //-------------------------------------------
// Look for new cards
  if ( ! mfrc522.PICC_IsNewCardPresent()) {
    return "0";
  }

  // Select one of the cards
  if ( ! mfrc522.PICC_ReadCardSerial()) {
    return "1";
  }
 

  Serial.println(F("**Card Detected:**"));

  //-------------------------------------------

  //mfrc522.PICC_DumpDetailsToSerial(&(mfrc522.uid)); //dump some details about the card
  Serial.print(F("Card UID:"));    //Dump UID
  String conteudo = "";
  for (byte i = 0; i < mfrc522.uid.size; i++) {
    conteudo.concat(String(mfrc522.uid.uidByte[i] < 0x10 ? "0" : ""));
    conteudo.concat(String(mfrc522.uid.uidByte[i], HEX));
    Serial.print(mfrc522.uid.uidByte[i] < 0x10 ? " 0" : " ");
    Serial.print(mfrc522.uid.uidByte[i], HEX);
  }
  //char UUID[9];
  //conteudo.toCharArray(UUID, 9);
  //mfrc522.PICC_DumpToSerial(&(mfrc522.uid));      //uncomment this to see all blocks in hex

  //-------------------------------------------

  //----------------------------------------

  Serial.println(F("\n**End Reading**\n"));

  delay(1000); //change value if you want to read cards faster

  mfrc522.PICC_HaltA();
  mfrc522.PCD_StopCrypto1();
  //lcd.print(conteudo);
  return conteudo;
}
