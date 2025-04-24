import React from 'react';
import {
  View,
  Text,
  Image,
  ScrollView,
  TouchableOpacity,
  Linking,
} from 'react-native';
import { useRouter } from 'expo-router';
import { styles } from '../components/styles/landingStyles';

export default function LandingScreen() {
  const router = useRouter();

  return (
    <ScrollView style={styles.container}>
      <View style={styles.header}>
        <Image source={require('../assets/images/logo.png')} style={styles.logo} />
        <TouchableOpacity onPress={() => router.push('/Login')}>
          <Text style={styles.link}>Inicio de sesión</Text>
        </TouchableOpacity>
      </View>

      <View style={styles.promocional}>
        {[
          {
            title: 'Estilo Inigualable',
            description: 'Cortes que reflejan tu estilo y resaltan tu singularidad.',
          },
          {
            title: 'Confianza Renovada',
            description: 'Mejora tu estilo y tu confianza con nuestros servicios.',
          },
          {
            title: 'Productos de Calidad',
            description: 'Cuidamos tu piel y barba con productos de primera.',
          },
          {
            title: 'Experiencia Premium',
            description: 'Servicio exclusivo cada vez que nos visitas.',
          },
        ].map((item, idx) => (
          <View key={idx} style={styles.elementorBox}>
            <Text style={styles.elementorTitle}>{item.title}</Text>
            <Text style={styles.elementorText}>{item.description}</Text>
          </View>
        ))}
      </View>

      <View style={styles.services}>
        <Text style={styles.servicesTitle}>Servicios que Ofrecemos</Text>
        <View style={styles.serviceList}>
          {[
            {
              img: require('../assets/images/corte_cabello.jpg'),
              title: 'Corte de Cabello',
              desc: 'Cortes personalizados para tu estilo único.',
            },
            {
              img: require('../assets/images/arreglo_barba.png'),
              title: 'Arreglo de Barba',
              desc: 'Mantén tu barba con recortes e hidratación.',
            },
            {
              img: require('../assets/images/decoloracion.jpg'),
              title: 'Decoloraciones capilares',
              desc: 'Transforma tu look con colores únicos.',
            },
            {
              img: require('../assets/images/afeitado.jpg'),
              title: 'Afeitado Profesional',
              desc: 'Afeitado tradicional para una piel suave.',
            },
          ].map((serv, idx) => (
            <View key={idx} style={styles.serviceItem}>
              <Image source={serv.img} style={styles.serviceImage} />
              <Text style={styles.serviceTitle}>{serv.title}</Text>
              <Text style={styles.serviceDesc}>{serv.desc}</Text>
            </View>
          ))}
        </View>
      </View>

      <View style={styles.mapSection}>
        <Text style={styles.servicesTitle}>Nuestra Ubicación</Text>
        <TouchableOpacity
          onPress={() => Linking.openURL('https://goo.gl/maps/YGy9ZuhzPfqQekFD7')}
        >
          <Text style={styles.mapLink}>Ver en Google Maps</Text>
        </TouchableOpacity>
      </View>

      <View style={styles.footer}>
        <Text style={styles.footerText}>© 2024 BAR_BER_GO.</Text>
      </View>
    </ScrollView>
  );
}

