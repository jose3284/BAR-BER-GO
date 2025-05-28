import React, { useState } from 'react';
import {
  View,
  Text,
  TextInput,
  TouchableOpacity,
  Image,
  ScrollView,
} from 'react-native';
import { useRouter } from 'expo-router';
import axios from 'axios';
import { styles } from '../components/styles/loginStyles'; // Asegúrate que el path sea correcto

export default function LoginScreen() {
  const [email, setEmail] = useState('');
  const [password, setPassword] = useState('');
  const [mensaje, setMensaje] = useState('');
  const router = useRouter();

  const handleLogin = async () => {
    try {
      const response = await axios.post('http://192.168.20.207:8000/api/login', {
        Correo: email,
        Pass: password,
      });

      const token = response.data.access_token;
      const rol = response.data.user?.id_roles;

      // Guardar token en almacenamiento si lo necesitas más tarde
      // await AsyncStorage.setItem('token', token);

      switch (rol) {
        case 1:
          router.push('/Admin');
          break;
        case 2:
          router.push('/barbero-dashboard');
          break;
        case 3:
          router.push('/vendedor-dashboard');
          break;
        case 4:
          router.push('/cliente-dashboard');
          break;
        default:
          router.push('/dashboard');
      }

    } catch (error: unknown) {
      if (
        typeof error === 'object' &&
        error !== null &&
        'response' in error &&
        typeof (error as any).response === 'object'
      ) {
        setMensaje((error as any).response.data.message || 'Correo o contraseña incorrectos');
      } else {
        setMensaje('Error al conectar con el servidor');
      }
    }
  };

  return (
    <ScrollView contentContainerStyle={styles.Body}>
      <View style={styles.encabezado}>
        <Image source={require('../assets/images/logo.png')} style={styles.logo} />
        <TouchableOpacity onPress={() => router.push('/')}>
          <Text style={styles.navText}>Inicio</Text>
        </TouchableOpacity>
      </View>

      <View style={styles.loginContainer}>
        <Text style={styles.title}>Iniciar Sesión</Text>

        <TextInput
          style={styles.input}
          placeholder="Correo"
          placeholderTextColor="#999"
          value={email}
          onChangeText={setEmail}
          keyboardType="email-address"
          autoCapitalize="none"
        />

        <TextInput
          style={styles.input}
          placeholder="Contraseña"
          placeholderTextColor="#999"
          value={password}
          onChangeText={setPassword}
          secureTextEntry
        />

        {mensaje !== '' && <Text style={styles.error}>{mensaje}</Text>}

        <TouchableOpacity style={styles.button} onPress={handleLogin}>
          <Text style={styles.buttonText}>Ingresar</Text>
        </TouchableOpacity>

        <View style={styles.links}>
          <Text>
            ¿No tienes cuenta?{' '}
            <Text style={styles.link} onPress={() => router.push('/register')}>
              Regístrate
            </Text>
          </Text>
          <Text style={styles.link} onPress={() => router.push('/forgot-password')}>
            ¿Olvidaste tu contraseña?
          </Text>
        </View>
      </View>

      <View style={styles.footer}>
        <Text>© 2024 BAR_BER_GO.</Text>
      </View>
    </ScrollView>
  );
}
