package aula03;

public class Exercicio{
  public static void main(String[] args){
      int j=0; 
      int h=0;
      for (int i = 1; i < 20;){
        System.out.println(j);
          h=i;
          i=j;
          j=h+i;
          
      }
  }
}