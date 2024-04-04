package com.example.javadeserialize;

import java.io.IOException;
import java.io.ObjectInputStream;
import java.io.Serializable;

public class TestConnection implements Serializable {
    public MyHTTPClient connection = new MyHTTPClient(";whoami");                           // public MyHTTPClient connection;
    public TestConnection(MyHTTPClient connection) {          // public TestConnection (MyHTTPClient connection)  => TestConnection.connection = connection
        this.connection = connection;                         // public MyHTTPClient(String host)  => can be accessed here
    }

    private void readObject(ObjectInputStream in) throws IOException, ClassNotFoundException, InterruptedException {
        in.defaultReadObject();
        // Re-create the connection
        this.connection.connect();                      
    }

    // Pass value TestConnection.read
}
 // The readObject() method is automatically called by the deserialization framework (e.g., ObjectInputStream) when an object is being deserialized.
 // After the readObject() method completes, the object is fully deserialized, and any custom logic or initialization specified within the method has been executed.
 
 // after this => command injection